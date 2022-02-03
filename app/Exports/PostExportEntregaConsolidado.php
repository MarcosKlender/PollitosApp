<?php
namespace App\Exports;
use App\Entregas;
use App\RegistrosEntregas;
use App\PresasEntregas;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Exports\PostsExportEntrega;

class PostExportEntregaConsolidado implements FromView, WithTitle, WithEvents, WithColumnFormatting
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

        $entregas = Entregas::where('id', $datoid)->get();

        $registros = RegistrosEntregas::where('entregas_id', $datoid)->get();

        $presas = PresasEntregas::where('entregas_id', $datoid)->get();

        $eCantidad_gavetas = RegistrosEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');

        $ePeso_bruto = RegistrosEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');

        $Total_cgaveta_presas = PresasEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');

        $Total_pbruto_presas = PresasEntregas::where('entregas_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');

        $TPN = $ePeso_bruto + $Total_pbruto_presas;


        $anulado = Entregas::where('id',$datoid)->select('anulado')->value('anulado');

        $liquidado = Entregas::where('id',$datoid)->select('liquidado')->value('liquidado');

        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }

        return view('reportesentregas.excelviews.entregaconsolidadoexcel',['entregas',$entregas],['registros',$registros])->with('entregas', $entregas)->with('presas', $presas)->with('id', $datoid)->with('eCantidad_gavetas', $eCantidad_gavetas)->with('PB',$ePeso_bruto)->with('PP', $Total_pbruto_presas)->with('Total_cgaveta_presas', $Total_cgaveta_presas)->with('TPN',$TPN)->with('liquidado', $est_liquidado);

    }

    public function title():string {
        return 'Consolidado';

    }

     public function registerEvents(): array
     {

        $borderMedium = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];


        $FuenteLetra = [
            'font' => [
                'bold' => true,
                'size' => 11
            ],
        ];


        $iColorFondo = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'E1C000')
            ),
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['argb' => '000000'],
                ],
            ],
            'font' => [
                'bold' => true,
                'size' => 12
            ],
        ];

        $iColorFondo2 = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'FBF893')
            ),
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['argb' => '000000'],
                ],
            ],
             'font' => [
                'bold' => true,
                'size' => 11
            ],
        ];


         $iColorFondo3 = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => '92D050')
            ),
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['argb' => '000000'],
                ],
            ],
             'font' => [
                'bold' => true,
                'size' => 12
            ],
        ];


        return [
            AfterSheet::class => function(AfterSheet $event) use ($borderMedium, $FuenteLetra, $iColorFondo, $iColorFondo2, $iColorFondo3)
            {

                //Cuadriculas
                $event->sheet->getStyle('A9:C11')->ApplyFromArray($borderMedium);
                $event->sheet->getStyle('A13:C19')->ApplyFromArray($borderMedium);
                $event->sheet->getStyle('A21:C21')->ApplyFromArray($borderMedium);

                //Color celdas
                $event->sheet->getStyle('A10:A11')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('A14:C14')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('A19:C19')->ApplyFromArray($iColorFondo);
                $event->sheet->getStyle('A21:C21')->ApplyFromArray($iColorFondo3);






            }
        ];


     }

    public function columnFormats(): array {

        return [
                'B'=>NumberFormat::FORMAT_NUMBER,
            ];

    }



}


