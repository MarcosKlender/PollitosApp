<?php
namespace App\Exports;

use App\Registros;
use App\Egresos;
use App\GavetasVacias;
use App\GavetasVaciasEgresos;
use App\Lotes;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Exports\PostExportLoteConsolidado;
use App\Exports\PostsExport;

class PostExportLoteConsolidado implements FromView, WithTitle, WithEvents, WithColumnFormatting
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


	  	//query INGRESOS
	  	$lotes = Lotes::where('id', $this->id)->get();

	  	$iCantidadga = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');

	  	$iTotal_Pbruto = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');  

	  	$iTotal_Cgvacia = GavetasVacias::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

	  	$iTotal_Pgvacia = GavetasVacias::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');

	  	$iCantidad_hogados = Lotes::where('id', $datoid)->where('anulado', 0)->select('cant_ahogados')->sum('cant_ahogados');

	  	$iPeso_hogados = Lotes::where('id', $datoid)->where('anulado', 0)->select('peso_ahogados')->sum('peso_ahogados'); 

	  	// Total peso neto
	  	$iTPN = ( $iTotal_Pbruto - $iTotal_Pgvacia -  $iPeso_hogados );


	  	//query EGRESOS

	  	$eCantidad_gavetas = Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');

	  	$eTotal_Pbruto = Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');


	  
	  	$eCantidad_gvacias = GavetasVaciasEgresos::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

	  	$eTotal_Pgvacias = GavetasVaciasEgresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');

	  	

	  	$eCantidad_gvacia_mollejas = Lotes::where('id', $datoid)->where('anulado', 0)->select('cant_gvacia_mollejas_egresos')->sum('cant_gvacia_mollejas_egresos'); 

	  	$ePeso_mollejas = Lotes::where('id', $datoid)->where('anulado', 0)->select('peso_mollejas_egresos')->sum('peso_mollejas_egresos'); 

	  	//Total peso neto 
	  	$eTPN = ($eTotal_Pbruto - $eTotal_Pgvacias ) + $ePeso_mollejas;

	  	
	  	$eTotal_Cgvacia_ahogados = Lotes::where('id', $datoid)->where('anulado', 0)->select('cant_gvacia_ahogados_egresos')->sum('cant_gvacia_ahogados_egresos');

	  	$eCantidad_ahogados = Lotes::where('id', $datoid)->where('anulado', 0)->select('cant_ahogados_egresos')->sum('cant_ahogados_egresos');

	  	$ePeso_ahogados = Lotes::where('id', $datoid)->where('anulado', 0)->select('peso_ahogados_egresos')->sum('peso_ahogados_egresos');



	  	$eCantidad_gvacia_estropeados = Lotes::where('id', $datoid)->where('anulado', 0)->select('cant_gvacia_estropeados_egresos')->sum('cant_gvacia_estropeados_egresos');

	  	$eCantidad_estropeados =   Lotes::where('id', $datoid)->where('anulado', 0)->select('cant_estropeados_egresos')->sum('cant_estropeados_egresos');

	  	$ePeso_estropeados = Lotes::where('id', $datoid)->where('anulado', 0)->select('peso_estropeados_egresos')->sum('peso_estropeados_egresos');

	  	//Total desperdicio 
	  	$eTD = ($ePeso_ahogados + $ePeso_estropeados);

	  	//Total neto INGRESO y EGRESO


	  	$ieTN = $iTPN-($eTPN - $eTD ); 


	  		  	
	  	$anulado = Lotes::where('id',$datoid)->select('anulado')->value('anulado');
        $liquidado = Lotes::where('id',$datoid)->select('liquidado')->value('liquidado');

        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }



	  	return view('reportes.excelviews.loteconsolidadoexcel', [ 'lotes'=> $lotes])->with('id',$this->id)->with('iCantidadga',$iCantidadga)->with('iPB',$iTotal_Pbruto)->with('iTotal_Cgvacia',$iTotal_Cgvacia)->with('iPGV',$iTotal_Pgvacia)->with('iCantidad_ahogados',$iCantidad_hogados)->with('iPH',$iPeso_hogados)->with('iTPN', $iTPN)->with('eCantidad_gavetas', $eCantidad_gavetas)->with('ePB', $eTotal_Pbruto)->with('eCantidad_gvacia_mollejas', $eCantidad_gvacia_mollejas)->with('ePM', $ePeso_mollejas)->with('eTotal_Cgvacia_ahogados',$eTotal_Cgvacia_ahogados)->with('eCantidad_ahogados', $eCantidad_ahogados)->with('ePeso_ahogados', $ePeso_ahogados)->with('eCantidad_gvacias', $eCantidad_gvacias)->with('ePGV', $eTotal_Pgvacias)->with('eTPN', $eTPN)->with('eCantidad_gvacia_estropeados', $eCantidad_gvacia_estropeados)->with('eCantidad_estropeados', $eCantidad_estropeados)->with('ePE', $ePeso_estropeados)->with('eTD', $eTD)->with('ieTN',$ieTN)->with('liquidado', $est_liquidado);
	  	 

  	}


	 public function title(): string 
	 {
        return 'Consolidado ';
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

        $colCenter = [
            'alignment' => [
                'horizontal' => 'center'
            ]
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
                'startColor' => array('argb' => 'DCE6F1')
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

        $eColorFondo = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'FCB2A2')
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

         $TColorFondo = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'C5D9F1')
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

         $TNColorFondo = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'EEECE1')
            ),
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['argb' => '000000'],
                ],
            ],
            'font' => [
                'bold' => true,
                'size' => 11,
                'color' => ['argb' => 'BE504D'],
            ],

        ];

        return [
            AfterSheet::class => function(AfterSheet $event) use ($FuenteLetra, $borderMedium, $colCenter, $iColorFondo, $iColorFondo2, $eColorFondo, $TColorFondo, $TNColorFondo)
            {

            	//Cabecera principal
            	$event->sheet->getStyle('A1:A7')->ApplyFromArray($FuenteLetra);

            	// Color titulos - INGRESOS
                $event->sheet->getStyle('A8:B8')->ApplyFromArray($iColorFondo);

                // Color titulos - EGRESOS
                $event->sheet->getStyle('D8:I8')->ApplyFromArray($iColorFondo);

                //cuadricula - INGRESOS
                $event->sheet->getStyle('A9:B18')->ApplyFromArray($borderMedium);

                //cuadricula - EGRESOS
                $event->sheet->getStyle('D9:E18')->ApplyFromArray($borderMedium);
                $event->sheet->getStyle('G9:I15')->ApplyFromArray($borderMedium);

                //TITULOS SECUNDARIOS INGRESOS - EGRESOS
                $event->sheet->getStyle('A9:I9')->ApplyFromArray($FuenteLetra);
                $event->sheet->getStyle('A12:I12')->ApplyFromArray($FuenteLetra);
                $event->sheet->getStyle('A15:I15')->ApplyFromArray($FuenteLetra);

                //SUBTITULOS INGRESOS - EGRESOS
                $event->sheet->getStyle('A10:B10')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('D10:E10')->ApplyFromArray($eColorFondo);
                $event->sheet->getStyle('G10:I10')->ApplyFromArray($eColorFondo);

                $event->sheet->getStyle('A13:B13')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('D13:E13')->ApplyFromArray($eColorFondo);
                $event->sheet->getStyle('G13:I13')->ApplyFromArray($eColorFondo);

                $event->sheet->getStyle('A16:B16')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('D16:E16')->ApplyFromArray($eColorFondo);



                $event->sheet->getStyle('G15:I15')->ApplyFromArray($TColorFondo);
                $event->sheet->getStyle('A18:B18')->ApplyFromArray($TColorFondo);
                $event->sheet->getStyle('D18:E18')->ApplyFromArray($TColorFondo);

                $event->sheet->getStyle('G18:I18')->ApplyFromArray($TNColorFondo);


            }
        ];


     }

     public function columnFormats(): array {

        return [
                'B'=>NumberFormat::FORMAT_NUMBER,
            ];

    }

}