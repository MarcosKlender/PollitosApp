<?php
/*namespace App\Exports;

use App\Lotes;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use App\Exports\PostsExport;
use App\Clientes;
//use App\Lotes;
use App\Registros;
use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;
//use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\FromView;

class PostsExport implements FromView
{
    use Exportable;

    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
  /*  public function view()
    {
     $registros = Registros::orderBy('id')->get();
     $return = \View::make('reportes.excelviews.lotdetexcel')->with('lotes',$lotes)->with('registros',$registros)->with('count',$count)->with('id_lote',$id)->render();
     
    }
}*/

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


