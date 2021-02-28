<?php
namespace App\Exports;
use App\Registros;
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

        return view('reportes.excelviews.lotdetexcel', ['registros' => Registros::where('lotes_id', $this->id)->get()], 
        	[ 'lotes' => Lotes::where('id', $this->id)->get()
        ])->with('id',$datoid)->with('total_cantidad',$total_cantidad)->with('total_bruto',$total_bruto)->with('total_gavetas',$total_gavetas)->with('total_final',$total_final);
    }
}


