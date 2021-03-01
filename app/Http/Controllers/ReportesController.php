<?php

namespace App\Http\Controllers;
use App\Clientes;
use App\Lotes;
use App\Registros;
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
        

         $lotes = Lotes::all_index()->orderBy('lotes.id')->paginate(4);
         $count = count($lotes);
         return view('reportes.index', compact('lotes','count'));
    }

   
  

    public function show(Request $request)
    {

        $criterio_liquidado = $request->get('criterio_liquidado');
        $criterio_anulado = $request->get('criterio_anulado');
        $criterio_tipo = $request->get('criterio_tipo');
        $criterio_proveedor = $request->get('criterio_proveedor');
        $criterio_procedencia = $request->get('criterio_procedencia');
        $criterio_placa = $request->get('criterio_placa');
        $criterio_conductor = $request->get('criterio_conductor');
        $criterio_usuario = $request->get('criterio_usuario');
        $criterio_fecha_ini = $request->get('criterio_fecha_ini');
        $criterio_fecha_fin = $request->get('criterio_fecha_fin');

            $lotes = Lotes::all_index()
            ->tipo($criterio_tipo)
            ->proveedor($criterio_proveedor)
            ->procedencia($criterio_procedencia)
            ->placa($criterio_placa)
            ->conductor($criterio_conductor)
            ->usuario($criterio_usuario)
            ->anulado($criterio_anulado)
            ->liquidado($criterio_liquidado)
            ->fecha($criterio_fecha_ini,$criterio_fecha_fin)
            ->orderBy('lotes.id')
            ->paginate(5);


        $count = count($lotes);

       // return dd($request);
       return view('reportes.index', compact('lotes', 'count'));
    }



    public function lotes_anulados()
    {
        $lotes = Lotes::orderBy('id', 'desc')->paginate(8);
        $count = count($lotes);

        if (Auth::user()->rol->key != 'admin')
        {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.lotes_anulados', compact('lotes', 'count'));
    }

  
    public function registros_anulados()
    {
        $registros = Registros::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($registros);

        if (Auth::user()->rol->key != 'admin')
        {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.registros_anulados', compact('registros', 'count'));
    }

    public function generar_pdf($id)
    {
    $pdf = \App::make('dompdf.wrapper');
    
    $lotes = Lotes::all_index()->orderBy('lotes.id')->paginate(10000);
    $registros = Registros::orderBy('id')->get();
     $count = count($lotes);
     $view = \View::make('reportes.pdfviews.lotepdf')->with('lotes',$lotes)->with('registros',$registros)->with('count',$count)->with('id_lote',$id)->render();
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
   
        
        return $registros;
    } 
    
    public function generar_excel($id)
    {
    return (new PostsExport($id))->download('lotes.xlsx');
    }
   
}
