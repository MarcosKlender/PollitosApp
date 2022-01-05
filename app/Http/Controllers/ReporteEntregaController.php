<?php

namespace App\Http\Controllers;

use App\Entregas;
use App\Clientes;
use Illuminate\Http\Request;


class ReporteEntregaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $entregas = Entregas::all_index()->orderBy('entregas.id', 'DESC')->paginate(4);
        $count = count($entregas);
        return view('reportes.index', compact('entregas', 'count'));
    }


    public function generar_pdf($id)
    {
        $pdf = \App::make('dompdf.wrapper');
    
        $entregas = Entregas::all_index()->orderBy('entregas.id')->paginate(10000);
      
        $count = count($entregas);
        $view = \View::make('reportes.pdfviews.entregapdf')->with('entregas', $entregas)->with('count', $count)->with('id', $id)->render();

        $pdf->loadHTML($view);
        //return dd($id);
        return $pdf->stream();
    }

    public function generar_excel($id)
    {
        return (new PostsExport($id))->download('entregas.xlsx');
    }
}
