<?php

namespace App\Http\Controllers;

use App\Entregas;
use App\RegistrosEntregas;
use App\PresasEntregas;
use App\Clientes;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\PostsExportEntrega;
use App\Exports\PostExportEntregaConsolidadoGeneral;


class ReporteEntregaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $entregas = Entregas::all_index()->orderBy('entregas.id', 'DESC')->paginate(15);
        $count = count($entregas);
        return view('reportesentregas.index', compact('entregas', 'count'));
    }


    public function show(Request $request)
    {
        $criterio_liquidado = $request->get('criterio_liquidado');
        $criterio_anulado = $request->get('criterio_anulado');
        $criterio_identrega = $request->get('criterio_identrega');
        $criterio_tipo = $request->get('criterio_tipo');
        $criterio_cliente = $request->get('criterio_cliente');
        $criterio_ruc_ci = $request->get('criterio_ruc_ci');
        $criterio_placa = $request->get('criterio_placa');
        $criterio_conductor = $request->get('criterio_conductor');
        $criterio_usuario = $request->get('criterio_usuario');
        $criterio_fecha_ini = $request->get('criterio_fecha_ini');
        $criterio_fecha_fin = $request->get('criterio_fecha_fin');

        $entregas = Entregas::all_index()
            ->identregas($criterio_identrega)
            ->tipo($criterio_tipo)
            ->cliente($criterio_cliente)
            ->identificacion($criterio_ruc_ci)
            ->conductor($criterio_conductor)
            ->usuario($criterio_usuario)
            ->anulado($criterio_anulado)
            ->liquidado($criterio_liquidado)
            ->fecha($criterio_fecha_ini, $criterio_fecha_fin)
            ->orderBy('entregas.id', 'DESC')
            ->paginate(15);

        $count = count($entregas);

        return view('reportesentregas.index', compact('entregas', 'count'));
    }


    public function generar_pdf($id)
    {
        $pdf = \App::make('dompdf.wrapper');
    
        $entregas = Entregas::all_index()->orderBy('entregas.id')->paginate(10000);
        $entregas_presas = Entregas::presas_entregas()->orderBy('id')->get();
        $registros_entregas = RegistrosEntregas::where('entregas_id', $id)->orderBy('id')->where('anulado', 0)->get();
        $presas_entregas = PresasEntregas::where('entregas_id', $id)->orderBy('id')->where('anulado', 0)->get();

        $anulado = Entregas::where('id',$id)->select('anulado')->value('anulado');
        $liquidado = Entregas::where('id',$id)->select('liquidado')->value('liquidado');

        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }
      
        $count = count($entregas);
        $view = \View::make('reportesentregas.pdfviews.entregapdf')->with('entregas', $entregas)->with('entregas_presas', $entregas_presas)->with('registros_entregas', $registros_entregas)->with('presas_entregas', $presas_entregas)->with('liquidado', $est_liquidado)->with('count', $count)->with('id_entrega', $id)->render();

        $pdf->loadHTML($view);
        return $pdf->stream();
    }

    public function generar_excel($id)
    {
        return (new PostsExport($id))->download('entregas.xlsx');
    }

    public function detalle_entrega()
    {
        $id=Request()->id;
        $registros = RegistrosEntregas::where('entregas_id', $id)->orderBy('id')->get();
        return $registros;
    }


     public function detalle_presas()
    {
        $id=Request()->id;
        $presas = PresasEntregas::where('entregas_id', $id)->orderBy('id')->get();
        return $presas;
    }

    public function generar_excel_entrega($id)
    {
        return (new PostsExportEntrega($id))->download('entregas.xlsx');
    }

     public function generar_excel_entrega_general()
    {


        $fechaini = Request()->fecha_desde;
        $fechafin = Request()->fecha_hasta;

       return (new PostExportEntregaConsolidadoGeneral($fechaini, $fechafin))->download('entregas_consolidado_general.xlsx');
   
    }

}
