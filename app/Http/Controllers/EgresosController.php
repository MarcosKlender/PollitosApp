<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Egresos;
use App\Basculas;
use App\Registros;
use App\GavetasVaciasEgresos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EgresosController extends Controller
{
    public function index()
    {
        if (Auth::user()->rol_id == 1) {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->paginate(8);
        } else {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->where('usuario', Auth::user()->username)->paginate(8);
        }

        $count = count($lotes);
        
        return view('egresos.index', compact('lotes', 'count'));
    }

    public function index2()
    {
        $user=auth()->user()->username;
        $busuario =Basculas::select("id")
            ->where('nom_user', '=', "$user")
            ->get();
        $e_automatico = Basculas::select("automatico")
            ->where('nom_user', '=', "$user")
            ->value("automatico");
   

        if (count($busuario)>0) {
            $busuario=$busuario[0]['id'];
        }
        if ($busuario==="B002" && $e_automatico==="1") {
            $ch = curl_init("http://192.168.100.12/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_URL, "http://192.168.100.12/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
            $res = curl_exec($ch);
            curl_close($ch);
        //$res="Con_accesoB001";
        } elseif ($busuario==="B002" && $e_automatico==="0") {
            $res="0";
        } else {
            $res="Sin_acceso";
        }

        return view('egresos.seccion', compact('res'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $lote = Lotes::findOrFail($id);
        $egresos = Egresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        $total_cantidad = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $total_bruto = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $total_gavetas = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');
        $total_final = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $gavetas = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $cant_gav_vac = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');
        $peso_gav_vac = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');

        return view('egresos.show', compact('lote', 'egresos', 'total_cantidad', 'total_bruto', 'total_gavetas', 'total_final', 'gavetas', 'cant_gav_vac', 'peso_gav_vac'));
    }

    public function edit($id)
    {
        $user=auth()->user()->username;
        $e_automatico = Basculas::select("automatico")
            ->where('nom_user', '=', "$user")
            ->value("automatico");

        $lote = Lotes::findOrFail($id);
        $egresos = Egresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        $total_ingresos = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');
        $total_egresos = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $gavetas = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $cant_gav = Registros::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $cant_gav_vac = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

        return view('egresos.edit', compact('lote', 'egresos', 'total_ingresos', 'total_egresos', 'e_automatico', 'gavetas', 'cant_gav', 'cant_gav_vac'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'lotes_id' => 'required|numeric',
            'cant_gavetas' => 'required|numeric|min:1',
            'peso_bruto' => 'required|numeric|min:1',
            'peso_gavetas' => '',
            'peso_final' => '',
            'tipo_peso' => 'required|size:2',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);
        
        Egresos::whereId($id)->create($updateData);

        $lote = Lotes::findOrFail($id);

        return redirect()->route('egresos.edit', $id)->with('lote');
    }

    public function destroy($id)
    {
        //
    }

    public function registros_anulados()
    {
        $egresos = Egresos::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($egresos);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/egresos');
        }
        
        return view('egresos.registros_anulados', compact('egresos', 'count'));
    }

    public function gavetas_anuladas()
    {
        $gavetas = GavetasVaciasEgresos::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($gavetas);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/egresos');
        }
        
        return view('egresos.gavetas_anuladas', compact('gavetas', 'count'));
    }

    public function anular_registro(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        Egresos::whereId($request->id_anular)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!');
    }

    public function registrar_gavetas(Request $request)
    {
        $updateData = $request->validate([
            'peso_gavetas' => 'required|numeric|min:1',
            'peso_final' => 'required|numeric'
        ]);
        
        Egresos::whereId($request->id_gavetas)->update($updateData);

        return back()->with('success', '¡El peso de las gavetas fue registrado exitosamente!');
    }

    public function liquidar_lote(Request $request)
    {
        $updateData = $request->validate([
            'egresos' => 'required|size:1',
        ]);
        
        Lotes::whereId($request->id_liquidar)->update($updateData);

        return redirect('/egresos')->with('success', '¡Lote liquidado exitosamente!');
    }
}
