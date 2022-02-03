<?php
namespace App\Exports;
use App\Entregas;
use App\RegistrosEntregas;
use App\PresasEntregas;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PostsExportEntrega;
use App\Exports\PostExportEntregaConsolidado;

class PostsExportEntrega implements FromView, WithTitle, WithColumnFormatting, WithMultipleSheets
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

        $total_cantidad = RegistrosEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $total_bruto = RegistrosEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
 
        $total_cantidad_pentrega =    PresasEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        $total_peso_pentrega =  PresasEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');

        $presas = PresasEntregas::where('entregas_id', $datoid)->get();

        $anulado = Entregas::where('id',$datoid)->select('anulado')->value('anulado');
        $liquidado = Entregas::where('id',$datoid)->select('liquidado')->value('liquidado');

        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }

        return view('reportesentregas.excelviews.entregaexcel',[ 'entregas' => Entregas::where('id', $this->id)->get()],['registros' => RegistrosEntregas::where('entregas_id', $this->id)->get()])->with('presas', $presas)->with('id', $datoid)->with('total_cantidad', $total_cantidad)->with('total_bruto',$total_bruto)->with('total_cantidad_pentrega', $total_cantidad_pentrega)->with('total_peso_pentrega', $total_peso_pentrega)->with('liquidado', $est_liquidado);

    }

    public function title():string {
        return 'Entregas y Presas';

    }

    public function sheets(): array
    {
        $sheets = [];
        array_push($sheets, new PostsExportEntrega($this->id) );
        array_push($sheets, new PostExportEntregaConsolidado($this->id) );
        return $sheets;
    }

    public function columnFormats(): array {

        return [
                'B'=>NumberFormat::FORMAT_NUMBER,
            ];

    }



}


