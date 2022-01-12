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

       /* $cant_ahogados  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_ahogados')->sum('cant_ahogados');
        $peso_ahogados  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_ahogados')->sum('peso_ahogados');
        $cant_gvacia_ahogados  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gvacia_ahogados')->sum('cant_gvacia_ahogados');


        $cant_estropeados  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_estropeados')->sum('cant_estropeados');
        $peso_estropeados  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_estropeados')->sum('peso_estropeados');
        $cant_gvacia_estropeados  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gvacia_estropeados')->sum('cant_gvacia_estropeados');

        $cant_mollejas  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_mollejas')->sum('cant_mollejas');
        $peso_mollejas  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_mollejas')->sum('peso_mollejas');
        $cant_gvacia_mollejas  = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gvacia_mollejas')->sum('cant_gvacia_mollejas'); */


        return view('egresos.show', compact('lote', 'egresos', 'total_cantidad', 'total_bruto', 'total_gavetas', 'total_final', 'gavetas', 'cant_gav_vac', 'peso_gav_vac'));
    }

    public function edit($id)
    {
        $user=auth()->user()->username;
        $e_automatico = Basculas::select("automatico")
            ->where('nom_user', '=', "$user")
            ->value("automatico");

            $id_bascula = Basculas::select("id")
            ->where('nom_user', '=', "$user")
            ->value("id"); 

            $tipo_peso = Basculas::select("tipo_peso")
            ->where('nom_user', '=', "$user")
            ->value("tipo_peso");

        $lote = Lotes::findOrFail($id);
        $egresos = Egresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        $total_ingresos = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');
        $total_egresos = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $gavetas = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $cant_gav = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $cant_gav_vac = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

        $lote_total_pbruto = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $egreso_total_pbruto = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');

        $estado_liquidado = Lotes::where('id',$id)->where('anulado',0)->select('liquidado')->value('liquidado');

        return view('egresos.edit', compact('lote', 'egresos', 'total_ingresos', 'total_egresos', 'e_automatico', 'id_bascula', 'gavetas','tipo_peso', 'cant_gav', 'cant_gav_vac','lote_total_pbruto','egreso_total_pbruto','estado_liquidado'));
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
            'liquidado' => 'required|size:1',
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

       /* $updateLote = $request->validate([
            'egresos' => 'required|size:1',
        ]);*/


        $updateLote = $request->validate([
            'egresos' => 'required|size:1',
            'liquidado' => 'required|size:1',
            'cant_ahogados_egresos' => 'required|numeric',
            'peso_ahogados_egresos' => 'required|numeric',
            'cant_gvacia_ahogados_egresos' => 'required|numeric',

            'cant_estropeados_egresos' => 'required|numeric',
            'peso_estropeados_egresos' => 'required|numeric',
            'cant_gvacia_estropeados_egresos' => 'required|numeric',

            'cant_mollejas_egresos' => 'required|numeric',
            'peso_mollejas_egresos' => 'required|numeric',
            'cant_gvacia_mollejas_egresos' => 'required|numeric',

        ]);




        $estado_liquidado = Lotes::where('id',$request->id_liquidar)->where('anulado',0)->select('liquidado')->value('liquidado');
        
        if($estado_liquidado === '1'){

             Lotes::whereId($request->id_liquidar)->update($updateLote);
             //Egresos::whereId($request->id_liquidar)->update($updateData);

             return redirect('/egresos')->with('success', '¡Lote liquidado exitosamente!');
        }else{
             return redirect('/egresos')->with('error', '¡Revisar que lote de ingresos este liquidado!');
        }


       
    }
}
