<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Basculas;
use App\Registros;
use App\Proveedores;
use App\GavetasVacias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PesoBrutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()->rol_id == 1) {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->paginate(8);
        } else {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->where('usuario', Auth::user()->username)->paginate(8);
        }

        $count = count($lotes);
        
        return view('pesobruto.index', compact('lotes', 'count'));
    }

    /* public function index2()
     {
         $ch = curl_init("http://192.168.0.103/ws.php?opcion=get");
         curl_setopt($ch, CURLOPT_URL, "http://192.168.0.103/ws.php?opcion=get");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);
         $res = curl_exec($ch);
         curl_close($ch);

         return view('pesobruto.seccion', compact('res'));

     }*/

    public function calular_kilos($tipo_peso, $peso)
    {
        $libra = 2.20462;
        $peso_libra = 0;
        if ($tipo_peso == 'kg' && if_float($peso)) {
            $peso_libra = $peso * $libra;
            return $peso_libra;
        }
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
        $tipo_peso = Basculas::select("tipo_peso")
            ->where('nom_user', '=', "$user")
            ->value("tipo_peso");

        if (count($busuario)>0) {
            $busuario=$busuario[0]['id'];
        }
        if ($busuario==="B001" && $e_automatico==="1") {
            $ch = curl_init("http://192.168.100.241/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_URL, "http://192.168.100.11/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
            $res = curl_exec($ch);
            curl_close($ch);

        //$res = cacular_kilos($tipo_peso, $resultado);

        //$res="Con_accesoB001";
        } elseif ($busuario==="B001" && $e_automatico==="0") {
            $res="0";
        } else {
            $res="Sin_acceso";
        }

        return view('pesobruto.seccion', compact('res'));
    }
    
    public function create()
    {
        $proveedores = Proveedores::select('pro_nombre', 'pro_ruc')->get();

        return view('pesobruto.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        //dd($request);

        $storeData = $request->validate([
            'tipo' => 'required|max:191',
            'cantidad' => 'required|numeric|min:1',
            'proveedor' => 'required|max:191',
            /*'ruc_ci' => 'required|digits_between:10,13|unique:lotes,pro_ruc'.$id, */
            'ruc_ci' => 'required|digits_between:10,13',
            'procedencia' => 'required|regex:/^[\pL\pM\pN\s]+$/u|max:191',
            'placa' => 'required|regex:/^[\pL\pM\pN\s]+$/u|between:6,7',
            'conductor' => 'required|regex:/^[\pL\pM\pN\s]+$/u|max:191',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
            'liquidado' => 'required|size:1',
            'visceras' => 'required|size:1',
            'egresos' => 'required|size:1',
        ]);

        $lotes = Lotes::create($storeData);

        // Mantener datos del formulario
        $request->old('proveedor');
        $request->old('procedencia');
        $request->old('placa');
        $request->old('conductor');

        return redirect('/pesobruto')->with('success', '¡Lote creado exitosamente!');
    }
    
    public function selectSearch(Request $request)
    {
        $proveedores = [];

        if ($request->has('q')) {
            $search = $request->q;
            $proveedor = Proveedores::select("pro_ruc", "pro_nombre")
                    ->where('pro_nombre', 'iLIKE', "%$search%")
                    ->get();
        }

        return response()->json($proveedor);
    }

    public function show($id)
    {
        $lote = Lotes::findOrFail($id);
        $registros = Registros::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        $total_cantidad = Registros::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $total_bruto = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $total_gavetas = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');
        $total_final = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $gavetas = GavetasVacias::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $cant_gav_vac = GavetasVacias::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');
        $peso_gav_vac = GavetasVacias::where('lotes_id', $id)->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');

        return view('pesobruto.show', compact(
            'lote',
            'registros',
            'total_cantidad',
            'total_bruto',
            'total_gavetas',
            'total_final',
            'gavetas',
            'cant_gav_vac',
            'peso_gav_vac'
        ));
    }

    public function edit($id)
    {
        $user=auth()->user()->username;
        $e_automatico = Basculas::select("automatico")
            ->where('nom_user', '=', "$user")
            ->value("automatico");
        $tipo_peso = Basculas::select("tipo_peso")
            ->where('nom_user', '=', "$user")
            ->value("tipo_peso");

        $lote = Lotes::findOrFail($id);
        $registros = Registros::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        
        $gavetas = GavetasVacias::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $cant_gav = Registros::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $cant_gav_vac = GavetasVacias::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

        return view('pesobruto.edit', compact('lote', 'registros', 'gavetas', 'tipo_peso', 'e_automatico', 'cant_gav', 'cant_gav_vac'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'lotes_id' => 'required|numeric',
            'cant_gavetas' => 'required|numeric|min:1',
            'cant_pollos' => '',
            'peso_bruto' => 'required|numeric|min:1',
            //'peso_gavetas' => '',
            'peso_final' => '',
            'tipo_peso' => 'required|size:2',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);
        
        Registros::whereId($id)->create($updateData);

        $lote = Lotes::findOrFail($id);

        return redirect()->route('pesobruto.edit', $id)->with('lote');
    }

    public function destroy($id)
    {
        //
    }

    public function lotes_anulados()
    {
        $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 1)->paginate(8);
        $count = count($lotes);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.lotes_anulados', compact('lotes', 'count'));
    }

    public function anular_lote(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        Lotes::whereId($request->id_anular)->update($updateData);

        return back()->with('success', '¡Lote actualizado exitosamente!');
    }

    public function registros_anulados()
    {
        $registros = Registros::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($registros);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.registros_anulados', compact('registros', 'count'));
    }

    public function gavetas_anuladas()
    {
        $gavetas = GavetasVacias::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($gavetas);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.gavetas_anuladas', compact('gavetas', 'count'));
    }

    public function anular_registro(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        Registros::whereId($request->id_anular)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!');
    }

    public function registrar_gavetas(Request $request)
    {
        $updateData = $request->validate([
            'peso_gavetas' => 'required|numeric|min:1',
            'peso_final' => 'required|numeric'
        ]);
        
        Registros::whereId($request->id_gavetas)->update($updateData);

        return back()->with('success', '¡El peso de las gavetas fue registrado exitosamente!');
    }

    public function liquidar_lote(Request $request)
    {
        $updateData = $request->validate([
            'liquidado' => 'required|size:1',
            'cant_ahogados' => 'required|numeric',
            'peso_ahogados' => 'required|numeric',
        ]);
        
        Lotes::whereId($request->id_liquidar)->update($updateData);

        return redirect('/pesobruto')->with('success', '¡Lote liquidado exitosamente!');
    }
}
