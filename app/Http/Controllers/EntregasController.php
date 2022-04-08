<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Entregas;
use App\PresasEntregas;
use App\RegistrosEntregas;
use App\Configuracion;
use App\Basculas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EntregasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //if (Auth::user()->rol_id == 1) {
            $entregas = Entregas::orderBy('id', 'desc')->where('anulado', 0)->paginate(10);
        /*}else{
            $entregas = Entregas::orderBy('id', 'desc')->where('anulado', 0)->where('usuario', Auth::user()->username)->paginate(10);
        }*/
        
        $count = count($entregas);
        return view('entregas.index', compact('entregas', 'count'));
    }


    public function index2()
    {
        $user=auth()->user()->username;

        $busuario =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'ENTREGAS')->get();

        $menu = Basculas::select("nom_menu")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'ENTREGAS')
        ->value('nom_menu');

        $cod_bascula =Basculas::select("id")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'ENTREGAS')->get();

        $e_automatico = Basculas::select("automatico")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'ENTREGAS')
            ->value("automatico");
        
        $tipo_peso = Basculas::select("tipo_peso")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'ENTREGAS')
            ->value("tipo_peso");

        $ipx_bascula = Basculas::select("ipx_bascula")->where('nom_user', '=', "$user")->where('nom_menu', '=', 'ENTREGAS')
            ->value("ipx_bascula");

        $cant_decimal_gv = Configuracion::select('val_conf')->where('ele_conf',"CANT_DEC_PB")->where('mod_conf', "ENTREGAS")->where('est_conf', 0)->value('val_conf');



        if (count($busuario)>0) {
            $busuario=$busuario[0]['cod_bascula'];
        }
        if ($menu==="ENTREGAS" && $e_automatico==="1") {
            $ch = curl_init("http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_URL, "http://$ipx_bascula/ws.php?opcion=get");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
            $respuesta = curl_exec($ch);
            curl_close($ch);
            $res = truncar_peso($respuesta,$cant_decimal_gv);

        } elseif ($menu==="ENTREGAS" && $e_automatico==="0") {
            $res="0";
        } else {
            $res="Sin_acceso";
        }

        return view('entregas.seccion_entregas', compact('res'));
    }

    public function create()
    {
        $clientes = Clientes::select('nombres', 'ruc_ci')->get();

        return view('entregas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $storeData = $request->validate([
            'tipo' => 'required|max:15',
            'ruc_ci' => 'required|digits_between:10,13',
            'cliente' => 'required|max:191',
            'placa' => 'nullable|regex:/^[\pL\pM\pN\s]+$/u|between:6,7',
            'conductor' => 'nullable|regex:/^[\pL\pM\pN\s]+$/u|max:191',
            'destino' => 'nullable|regex:/^[\pL\pM\pN\s]+$/u|max:191',
            'usuario_creacion' => 'required|max:191',
            'anulado' => 'required|size:1',
            'liquidado' => 'required|size:1',
            'tipo_entrega' => 'size:1'
        ]);

        $entregas = Entregas::create($storeData);

        // Mantener datos del formulario
        $request->old('tipo');
        $request->old('cliente');
        $request->old('placa');
        $request->old('conductor');
        $request->old('destino');
        $request->old('cant_animales');

        return redirect('/entregas')->with('success', '¡Entrega creada exitosamente!');
    }

    public function show($id)
    {
        $entregas = Entregas::findOrFail($id);
        $registros = RegistrosEntregas::where('entregas_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $presas = PresasEntregas::where('entregas_id', $id)->where('anulado', 0)->orderBy('id')->get();

        $total_gavetas = RegistrosEntregas::where('entregas_id',$id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $total_pneto = RegistrosEntregas::where('entregas_id',$id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');

        $total_presa_gavetas = PresasEntregas::where('entregas_id',$id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $total_presa_pneto = PresasEntregas::where('entregas_id',$id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');

        return view('entregas.show', compact('entregas', 'registros','total_gavetas','total_pneto','total_presa_gavetas','total_presa_pneto' ,'presas'));
    }

    public function edit($id)
    {
        $user=auth()->user()->username;

        $valor_cant_gavetas_llenas = Configuracion::select('val_conf')->where('ele_conf',"VALOR_CANT_GAVETAS_LLENAS")->where('mod_conf', "ENTREGAS")->where('est_conf', 0)->value('val_conf');

        $automatico_valor_cgavetas_llenas = Configuracion::select('aut_conf')->where('ele_conf',"VALOR_CANT_GAVETAS_LLENAS")->where('mod_conf', "ENTREGAS")->where('est_conf', 0)->value('aut_conf');


        $e_automatico = Basculas::select("automatico")->where('nom_menu', '=', 'ENTREGAS')
            ->where('nom_user', '=', "$user")
            ->value("automatico");

        $id_bascula = Basculas::select("cod_bascula")->where('nom_menu', '=', 'ENTREGAS')
            ->where('nom_user', '=', "$user")
            ->value("cod_bascula");

        $tipo_peso = Basculas::select("tipo_peso")->where('nom_menu', '=', 'ENTREGAS')
            ->where('nom_user', '=', "$user")
            ->value("tipo_peso");

        $menu = Basculas::select("nom_menu")
            ->where("nom_menu", '=', 'ENTREGAS')
            ->value("nom_menu");

        $entregas = Entregas::findOrFail($id);
        $registros = RegistrosEntregas::where('entregas_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $presas = PresasEntregas::where('entregas_id', $id)->where('anulado', 0)->orderBy('id')->get();
        $total_gavetas = RegistrosEntregas::where('entregas_id',$id)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');


     
        return view('entregas.edit', compact('entregas', 'registros', 'presas', 'e_automatico', 'menu', 'tipo_peso','total_gavetas' , 'valor_cant_gavetas_llenas','automatico_valor_cgavetas_llenas'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'entregas_id' => 'required|numeric',
            'cant_gavetas' => 'required|numeric|min:1',
            'peso_bruto' => 'required|numeric|min:1',
            'categoria_animales' => 'required',
            'tipo_peso' => 'required|size:2',
            'usuario_creacion' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);

        RegistrosEntregas::whereId($id)->create($updateData);

        $entregas = Entregas::findOrFail($id);

        return redirect()->route('entregas.edit', $id)->with('entregas');
    }

    public function destroy($id)
    {
        //
    }

    public function selectSearch(Request $request)
    {
        $clientes = [];

        if ($request->has('q')) {
            $search = $request->q;
            $cliente = Clientes::select("ruc_ci", "nombres")
                    ->where('nombres', 'iLIKE', "%$search%")
                    ->get();
        }

        return response()->json($cliente);
    }

    public function presas_anuladas()
    {
        $presas = PresasEntregas::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($presas);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/entregas');
        }
        
        return view('entregas.presas_anuladas', compact('presas', 'count'));
    }

    public function entregas_anuladas()
    {
        $entregas = Entregas::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($entregas);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/entregas');
        }
        
        return view('entregas.entregas_anuladas', compact('entregas', 'count'));
    }

    public function anular_entrega(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        Entregas::whereId($request->id_anular)->update($updateData);

        return back()->with('success', '¡Entrega actualizada exitosamente!');
    }

    public function registros_anulados()
    {
        $registros = RegistrosEntregas::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($registros);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/entregas');
        }
        
        return view('entregas.registros_anulados', compact('registros', 'count'));
    }

    public function anular_registro(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        RegistrosEntregas::whereId($request->id_anular)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!');
    }

    public function liquidar_lote(Request $request)
    {
        $updateData = $request->validate([
            'liquidado' => 'required|size:1',
            'cant_animales' => 'required|numeric',
        ]);
        
        Entregas::whereId($request->id_liquidar)->update($updateData);

        return redirect('/entregas')->with('success', '¡Lote liquidado exitosamente!');
    }
}
