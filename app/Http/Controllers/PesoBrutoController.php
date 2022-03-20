<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\BasculaConfiguracion;
use App\Configuracion;
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
       //if (Auth::user()->rol_id == 1) {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->paginate(8);
       /* } else {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->where('usuario', Auth::user()->username)->paginate(8);
        } */

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

        $busuario =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')->get();

        $menu = Basculas::select("nom_menu")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
        ->value('nom_menu');

        $cod_bascula =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')->get();

        $e_automatico = Basculas::select("automatico")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("automatico");
        
        $tipo_peso = Basculas::select("tipo_peso")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("tipo_peso");

        $ipx_bascula = Basculas::select("ipx_bascula")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("ipx_bascula");

        $cant_decimal_gv = Configuracion::select('val_conf')->where('ele_conf',"CANT_DEC_PB")->where('mod_conf', "INGRESOS")->where('est_conf', 0)->value('val_conf');


        if (count($busuario)>0) {
            $busuario=$busuario[0]['cod_bascula'];
        }


        if ( $menu==="INGRESOS"  && $e_automatico==="1") {
            $ch = curl_init("http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_URL, "http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
            $respuesta = curl_exec($ch);
            curl_close($ch);
            $res = truncar_peso($respuesta,$cant_decimal_gv);

        //$res = cacular_kilos($tipo_peso, $resultado);

        //$res="Con_accesoB001";
        } elseif ( $menu === "INGRESOS" && $e_automatico ==="0") {
            $res="0";
        } else {
            $res="Sin_acceso";
        }

        return view('pesobruto.seccion', compact('res'));
    }


    public function ws_gaveta_vacia()
    {
        $user=auth()->user()->username;

        $busuario =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')->get();

        $menu = Basculas::select("nom_menu")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
        ->value('nom_menu');

        $cod_bascula =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')->get();

        $e_automatico = Basculas::select("automatico")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("automatico");
        
        $tipo_peso = Basculas::select("tipo_peso")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("tipo_peso");

        $ipx_bascula = Basculas::select("ipx_bascula")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("ipx_bascula");

        $cant_decimal_gv = Configuracion::select('val_conf')->where('ele_conf',"CANT_DEC_GV")->where('mod_conf', "INGRESOS")->where('est_conf', 0)->value('val_conf');

        if (count($busuario)>0) {
            $busuario=$busuario[0]['cod_bascula'];
        }


        if ( $menu==="INGRESOS"  && $e_automatico==="1") {
            $ch = curl_init("http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_URL, "http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
            $respuesta = curl_exec($ch);
            curl_close($ch);
            $res = truncar_peso($respuesta,$cant_decimal_gv);

        //$res = cacular_kilos($tipo_peso, $resultado);

        //$res="Con_accesoB001";
        } elseif ( $menu === "INGRESOS" && $e_automatico ==="0") {
            $res="0";
        } else {
            $res="Sin_acceso";
        }

        return view('pesobruto.seccion_gvacia', compact('res'));
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
            'usuario_creacion' => 'required|max:191',
            'anulado' => 'required|size:1',
            'liquidado' => 'required|size:1',
            'visceras' => 'required|size:1',
            'estado_egresos' => 'required|size:1',
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

        return view('pesobruto.show', compact('lote', 'registros', 'total_cantidad', 'total_bruto', 'total_gavetas', 'total_final', 'gavetas', 'cant_gav_vac', 'peso_gav_vac'));
    }

    public function edit($id)
    {
        $user=auth()->user()->username;
        
        $e_automatico = Basculas::select("automatico")
            ->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("automatico");

        $id_bascula = Basculas::select("cod_bascula")
            ->where('nom_user', '=', "$user")->where('nom_menu', '=', 'INGRESOS')
            ->value("cod_bascula");    
        
        $tipo_peso = Basculas::select("tipo_peso")->where('nom_menu', '=', 'INGRESOS')
            ->where('nom_user', '=', "$user")
            ->value("tipo_peso");

        $menu = Basculas::select("nom_menu")->where("nom_menu", '=', "INGRESOS")
            ->where('nom_user', '=', "$user")
            ->value("nom_menu");

         $valor_cant_gaveta_llenas = Configuracion::select('val_conf')->where('ele_conf',"VALOR_CANT_GAVETAS_LLENAS")->where('mod_conf', "INGRESOS")->where('est_conf', 0)->value('val_conf');

         $automatico_valor_cgavetas_llenas = Configuracion::select('aut_conf')->where('ele_conf',"VALOR_CANT_GAVETAS_LLENAS")->where('mod_conf', "INGRESOS")->where('est_conf', 0)->value('aut_conf');

        $lote = Lotes::findOrFail($id);
        
        $registros = Registros::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        
        $gavetas = GavetasVacias::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        
        $cant_gav = Registros::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        
        $cant_gav_vac = GavetasVacias::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

        return view('pesobruto.edit', compact('lote', 'registros', 'gavetas', 'tipo_peso', 'e_automatico', 'id_bascula', 'menu','cant_gav', 'cant_gav_vac', 'valor_cant_gaveta_llenas', 'automatico_valor_cgavetas_llenas'));
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
            'usuario_creacion' => 'required|max:191',
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

        $registros = Registros::where('lotes_id', $request->id_anular)->where('anulado', 0)->get();
        $gavetas_vacias = GavetasVacias::where('lotes_id', $request->id_anular)->where('anulado', 0)->get();

        
        if( count($registros) === 0 && count($gavetas_vacias) === 0 ){

            Lotes::whereId($request->id_anular)->update($updateData);

            return back()->with('success', '¡Lote anulado exitosamente!');

        }else{

            return back()->with('error_anular', '¡No se puede anular Lote, revisar que no tenga registros !');

        }
        

       
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

    public function grabar_ahogados_lote(Request $request)
    {
        $updateData = $request->validate([
            'liquidado' => 'required|size:1',
            'cant_ahogados' => 'required|numeric',
            'peso_ahogados' => 'required|numeric',
        ]);
        
        Lotes::whereId($request->id_liquidar)->update($updateData);

        return back()->with('success', '¡Registros de ahogados grabados exitosamente!');
    }

    public function detalle_ahogados()
    {

        $id=Request()->id;
        $registros = Lotes::where('id', $id)->orderBy('id')->get();
       //dd($registros);
   
        
        return $registros;
    }


     public function liquidar_lote(Request $request)
    {
        $updateData = $request->validate([
            'liquidado' => 'required|size:1',
        ]);
        
        Lotes::whereId($request->id_liquidar)->update($updateData);

        return redirect('/pesobruto')->with('success', '¡Lote liquidado exitosamente!');
    }


}
