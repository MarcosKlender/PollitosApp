<?php
namespace App\Exports;
use App\Registros;
use App\Visceras;
use App\Egresos;
use App\Lotes;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\PostsExport;

class PostsExport implements FromView
{
	use Exportable;

    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function view(): View
    {
       $datoid=$this->id;
        $total_cantidad = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $total_bruto = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $total_gavetas = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');
        $total_final = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_final')->sum('peso_final');

     
        $totalv_bruto =    Visceras::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $totalv_gavetas =  Visceras::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');
        $totalv_final =    Visceras::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $totale_cantidad = Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $totale_bruto =    Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $totale_gavetas =  Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');
        $totale_final =    Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_final')->sum('peso_final');
        $viceras=   Visceras::where('lotes_id', $this->id)->get();
        $egresos=   Egresos::where('lotes_id', $this->id)->get();

        return view('reportes.excelviews.lotdetexcel',[ 'lotes' => Lotes::where('id', $this->id)->get()],['registros' => Registros::where('lotes_id', $this->id)->get()])->with('id',$datoid)->with('total_cantidad',$total_cantidad)->with('total_bruto',$total_bruto)->with('total_gavetas',$total_gavetas)->with('total_final',$total_final)->with('totalv_bruto',$totalv_bruto)->with('totalv_gavetas',$totalv_gavetas)->with('totalv_final',$totalv_final)->with('totale_cantidad',$totale_cantidad)->with('totale_bruto',$totale_bruto)->with('totale_gavetas',$totale_gavetas)->with('totale_final',$totale_final)->with('visceras',$viceras)->with('egresos',$egresos);


    }
}


