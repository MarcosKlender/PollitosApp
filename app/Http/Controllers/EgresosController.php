<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Egresos;
use App\Basculas;
use App\Registros;
use App\EgresosPresas;
use App\Configuracion;
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
            //$lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->where('usuario', Auth::user()->username)->paginate(8);
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->paginate(8);
        }

        $count = count($lotes);
        
        return view('egresos.index', compact('lotes', 'count'));
    }

    public function index2()
    {
        $user=auth()->user()->username;
        
        $busuario =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')->get();

        $menu = Basculas::select("nom_menu")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
        ->value('nom_menu');

        $cod_bascula =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')->get();

        $e_automatico = Basculas::select("automatico")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("automatico");
        
        $tipo_peso = Basculas::select("tipo_peso")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("tipo_peso");

        $ipx_bascula = Basculas::select("ipx_bascula")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("ipx_bascula");

        $cant_decimal_gv = Configuracion::select('val_conf')->where('ele_conf',"CANT_DEC_PB")->where('mod_conf', "EGRESOS")->where('est_conf', 0)->value('val_conf');

        if (count($busuario)>0) {
            $busuario=$busuario[0]['cod_bascula'];
        }
        if ($menu==="EGRESOS" && $e_automatico==="1") {
            $ch = curl_init("http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_URL, "http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
            $respuesta = curl_exec($ch);
            curl_close($ch);
            $res = truncar_peso($respuesta,$cant_decimal_gv);

        } elseif ($menu==="EGRESOS" && $e_automatico==="0") {
            $res="0";
        } else {
            $res="Sin_acceso";
        }

        return view('egresos.seccion', compact('res'));
    }


    public function ws_gaveta_vacia()
    {
        $user=auth()->user()->username;
        
        $busuario =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')->get();

        $menu = Basculas::select("nom_menu")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
        ->value('nom_menu');

        $cod_bascula =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')->get();

        $e_automatico = Basculas::select("automatico")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("automatico");
        
        $tipo_peso = Basculas::select("tipo_peso")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("tipo_peso");

        $ipx_bascula = Basculas::select("ipx_bascula")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("ipx_bascula");

        $cant_decimal_gv = Configuracion::select('val_conf')->where('ele_conf',"CANT_DEC_GV")->where('mod_conf', "EGRESOS")->where('est_conf', 0)->value('val_conf');

        if (count($busuario)>0) {
            $busuario=$busuario[0]['cod_bascula'];
        }
        if ($menu==="EGRESOS" && $e_automatico==="1") {
            $ch = curl_init("http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_URL, "http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
            $respuesta = curl_exec($ch);
            curl_close($ch);
            $res = truncar_peso($respuesta,$cant_decimal_gv);

        } elseif ($menu==="EGRESOS" && $e_automatico==="0") {
            $res="0";
        } else {
            $res="Sin_acceso";
        }

        return view('egresos.seccion_gvacia', compact('res'));
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
        //$total_final = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $gavetas = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        
        $cant_gav_vac = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');
        
        $peso_gav_vac = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');

        $egresos_presas = EgresosPresas::where('lotes_id', $id)->orderBy('id')->get();
    

        return view('egresos.show', compact('lote', 'egresos', 'egresos_presas', 'total_cantidad', 'total_bruto', 'total_gavetas', 'gavetas', 'cant_gav_vac', 'peso_gav_vac'));
    }

    public function edit($id)
    {
        $user=auth()->user()->username;

        $e_automatico = Basculas::select("automatico")
            ->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("automatico");

        $id_bascula = Basculas::select("cod_bascula")
            ->where('nom_user', '=', "$user")->where('nom_menu', '=', 'EGRESOS')
            ->value("cod_bascula");    
        
        $tipo_peso = Basculas::select("tipo_peso")->where('nom_menu', '=', 'EGRESOS')
            ->where('nom_user', '=', "$user")
            ->value("tipo_peso");

        $menu = Basculas::select("nom_menu")->where("nom_menu", '=', "EGRESOS")
            ->where('nom_user', '=', "$user")
            ->value("nom_menu");

        $lote = Lotes::findOrFail($id);
        $egresos = Egresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        $total_ingresos = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');
        $total_egresos = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $gavetas = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $cant_gav = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $cant_gav_vac = GavetasVaciasEgresos::where('lotes_id', $id)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

        $lote_total_pbruto = Registros::where('lotes_id', $id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $egreso_total_pbruto = Egresos::where('lotes_id', $id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');

        $estado_liquidado = Lotes::where('id', $id)->where('anulado', 0)->select('liquidado')->value('liquidado');

        return view('egresos.edit', compact('lote', 'egresos', 'total_ingresos', 'total_egresos', 'e_automatico', 'id_bascula','menu', 'gavetas', 'tipo_peso', 'cant_gav', 'cant_gav_vac', 'lote_total_pbruto', 'egreso_total_pbruto', 'estado_liquidado'));
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
            'usuario_creacion' => 'required|max:191',
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

   /* public function liquidar_lote(Request $request)
    {
       /* $updateLote = $request->validate([
            'egresos' => 'required|size:1',
        ]);*/

    /*    $updateLote = $request->validate([
            'egresos' => 'required|size:1',
            'liquidado' => 'required|size:1',
            'cant_ahogados_egresos' => 'required|numeric',
            'peso_ahogados_egresos' => 'required|numeric',
            'cant_gvacia_ahogados_egresos' => 'required|numeric',

            'cant_estropeados_egresos' => 'required|numeric',
            'peso_estropeados_egresos' => 'required|numeric',
            'cant_gvacia_estropeados_egresos' => 'required|numeric',

            //'cant_mollejas_egresos' => 'required|numeric',
            'peso_mollejas_egresos' => 'required|numeric',
            'cant_gvacia_mollejas_egresos' => 'required|numeric',

        ]);

        $estado_liquidado = Lotes::where('id', $request->id_liquidar)->where('anulado', 0)->select('liquidado')->value('liquidado');
        
        if ($estado_liquidado === '1') {
            Lotes::whereId($request->id_liquidar)->update($updateLote);
            //Egresos::whereId($request->id_liquidar)->update($updateData);

            return redirect('/egresos')->with('success', '¡Lote liquidado exitosamente!');
        } else {
            return redirect('/egresos')->with('error', '¡Revisar que lote de ingresos este liquidado!');
        }
    } */
}
