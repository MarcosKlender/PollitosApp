<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Lotes;
use App\Registros;
use App\GavetasVacias;
use App\GavetasVaciasEgresos;
use App\Visceras;
use App\Egresos;
use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\PostsExport;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {

        $lotes = Lotes::all_index()->orderBy('lotes.id', 'DESC')->paginate(4);
        $gavetas_vacias = Lotes::gavetas_vacias()->orderBy('id')->get();
         //$gavetas_vacias = GavetasVacias::orderBy('lotes_id','desc')->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');
         //dd($gavetas_vacias);
        $count = count($lotes);
        return view('reportes.index', compact('lotes', 'count','gavetas_vacias'));
    }

    public function show(Request $request)
    {
        $criterio_liquidado = $request->get('criterio_liquidado');
        $criterio_anulado = $request->get('criterio_anulado');
        $criterio_lote = $request->get('criterio_lote');
        $criterio_tipo = $request->get('criterio_tipo');
        $criterio_proveedor = $request->get('criterio_proveedor');
        $criterio_ruc_ci = $request->get('criterio_ruc_ci');
        $criterio_procedencia = $request->get('criterio_procedencia');
        $criterio_placa = $request->get('criterio_placa');
        $criterio_conductor = $request->get('criterio_conductor');
        $criterio_usuario = $request->get('criterio_usuario');
        $criterio_fecha_ini = $request->get('criterio_fecha_ini');
        $criterio_fecha_fin = $request->get('criterio_fecha_fin');
        $gavetas_vacias = Lotes::gavetas_vacias()->orderBy('id')->get();

        $lotes = Lotes::all_index()
            ->lote($criterio_lote)
            ->tipo($criterio_tipo)
            ->proveedor($criterio_proveedor)
            ->identificacion($criterio_ruc_ci)
            ->procedencia($criterio_procedencia)
            ->placa($criterio_placa)
            ->conductor($criterio_conductor)
            ->usuario($criterio_usuario)
            ->anulado($criterio_anulado)
            ->liquidado($criterio_liquidado)
            ->fecha($criterio_fecha_ini, $criterio_fecha_fin)
            ->orderBy('lotes.id', 'DESC')
            ->paginate(5);

        $count = count($lotes);

        return view('reportes.index', compact('lotes', 'gavetas_vacias', 'count'));
    }

    public function lotes_anulados()
    {
        $lotes = Lotes::orderBy('id', 'desc')->paginate(8);
        $count = count($lotes);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.lotes_anulados', compact('lotes', 'count'));
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

    public function generar_pdf($id)
    {
        $pdf = \App::make('dompdf.wrapper');
    
        $lotes = Lotes::all_index()->orderBy('lotes.id')->paginate(10000);
        $lotes_gavetas = Lotes::gavetas_vacias()->orderBy('id')->get();
        $lotes_gavetas_egresos = Lotes::gavetas_vacias_egresos()->orderBy('id')->get();
        $registros = Registros::orderBy('id')->where('anulado', 0)->get();
        $gavetas_vacias = GavetasVacias::orderBy('id')->where('anulado', 0)->get();
        $visceras = Visceras::where('lotes_id', $id)->get();
        $egresos = Egresos::where('lotes_id', $id)->where('anulado',0)->get();
        $gavetas_vacias_egresos = GavetasVaciasEgresos::orderBy('id')->where('anulado', 0)->get();
        $anulado = Lotes::where('id',$id)->select('anulado')->value('anulado');
        $liquidado = Lotes::where('id',$id)->select('liquidado')->value('liquidado');
        
        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }

        $count = count($lotes);
        $view = \View::make('reportes.pdfviews.lotepdf')->with('lotes', $lotes)->with('lotes_gavetas',$lotes_gavetas)->with('lotes_gavetas_egresos',$lotes_gavetas_egresos)->with('registros', $registros)->with('gavetas_vacias', $gavetas_vacias)->with('visceras', $visceras)->with('egresos', $egresos)->with('gavetas_vacias_egresos', $gavetas_vacias_egresos)->with('count', $count)->with('liquidado',$est_liquidado)->with('id_lote', $id)->render();

        $pdf->loadHTML($view);
        //return dd($id);
        return $pdf->stream();
    }
    
    public function generar_pdf_general($lotes)
    {
        return dd($lotes);
    }


    public function detalle_lotes()
    {
        $id=Request()->id;
        $registros = Registros::where('lotes_id', $id)->orderBy('id')->get();
       //dd($registros);
   
        
        return $registros;
    }

    public function detalle_gvacias()
    {
        $id=Request()->id;
        $gvacias = GavetasVacias::where('lotes_id', $id)->orderBy('id')->get();        
        return $gvacias;
    }


    public function detalle_visceras()
    {
        $id=Request()->id;
        $visceras = Visceras::where('lotes_id', $id)->orderBy('id')->get();

        return $visceras;
    }

    public function detalle_egresos()
    {
        $id=Request()->id;
        $egresos = Egresos::where('lotes_id', $id)->orderBy('id')->get();

        return $egresos;
    }

     public function detalle_gvacias_egresos()
    {
        $id=Request()->id;
        $gvaciase = GavetasVaciasEgresos::where('lotes_id', $id)->orderBy('id')->get();        
        return $gvaciase;
    }

    
    public function generar_excel($id)
    {
        return (new PostsExport($id))->download('lotes.xlsx');
    }
}
