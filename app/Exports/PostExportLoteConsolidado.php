<?php
namespace App\Exports;

use App\Registros;
use App\Egresos;
use App\GavetasVacias;
use App\GavetasVaciasEgresos;
use App\Lotes;
use App\EgresosPresas;
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

	  	
        
        $ePeso_gvacia_mollejas = EgresosPresas::where('lotes_id', $datoid)->select('peso_gvacia_mollejas_egresos')->sum('peso_gvacia_mollejas_egresos');
	  	//$eCantidad_gvacia_mollejas = EgresosPresas::where('lotes_id', $datoid)->select('cant_gvacia_mollejas_egresos')->sum('cant_gvacia_mollejas_egresos'); 

	  	$ePeso_mollejas = EgresosPresas::where('lotes_id', $datoid)->select('peso_mollejas_egresos')->sum('peso_mollejas_egresos'); 

	  	//Total peso neto 
	  	$eTPN = ($eTotal_Pbruto - $eTotal_Pgvacias - $ePeso_gvacia_mollejas ) + $ePeso_mollejas;

	  	
	  	$eTotal_Cgvacia_ahogados = EgresosPresas::where('lotes_id', $datoid)->select('cant_gvacia_ahogados_egresos')->sum('cant_gvacia_ahogados_egresos');

        $ePeso_gvacia_ahogados_egresos = EgresosPresas::where('lotes_id', $datoid)->select('peso_gvacia_ahogados_egresos')->sum('peso_gvacia_ahogados_egresos');


	  	$eCantidad_ahogados = EgresosPresas::where('lotes_id', $datoid)->select('cant_ahogados_egresos')->sum('cant_ahogados_egresos');

	  	$ePeso_ahogados = EgresosPresas::where('lotes_id', $datoid)->select('peso_ahogados_egresos')->sum('peso_ahogados_egresos');


	  	$eCantidad_gvacia_estropeados = EgresosPresas::where('lotes_id', $datoid)->select('cant_gvacia_estropeados_egresos')->sum('cant_gvacia_estropeados_egresos');

        $ePeso_gvacia_estropeados = EgresosPresas::where('lotes_id', $datoid)->select('peso_gvacia_estropeados_egresos')->sum('peso_gvacia_estropeados_egresos');

	  	$eCantidad_estropeados =   EgresosPresas::where('lotes_id', $datoid)->select('cant_estropeados_egresos')->sum('cant_estropeados_egresos');

	  	$ePeso_estropeados = EgresosPresas::where('lotes_id', $datoid)->select('peso_estropeados_egresos')->sum('peso_estropeados_egresos');

	  	//Total desperdicio 
	  	$eTD = ($ePeso_ahogados + $ePeso_estropeados) - ( $ePeso_gvacia_estropeados +  $ePeso_gvacia_ahogados_egresos);

	  	//Total neto INGRESO y EGRESO


	  	$ieTN = $iTPN-($eTPN - $eTD ); 


        //Precio por unidad de animal
        $eCantidad_animal = Lotes::where('id', $datoid)->select('cant_animales_egresos')->value('cant_animales_egresos');
        

        if ($eCantidad_animal >0  ){
            $iePU = $ieTN / $eCantidad_animal;  
            //
            $ieMA = ( $iTPN - $eTPN ) / $eCantidad_animal;   
        }else {
            $iePU = null; 
            $ieMA = null;
        }



	  		  	
	  	$anulado = Lotes::where('id',$datoid)->select('anulado')->value('anulado');
        $liquidado = Lotes::where('id',$datoid)->select('liquidado')->value('liquidado');

        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }



	  	return view('reportes.excelviews.loteconsolidadoexcel', [ 'lotes'=> $lotes])->with('id',$this->id)->with('iCantidadga',$iCantidadga)->with('iPB',$iTotal_Pbruto)->with('iTotal_Cgvacia',$iTotal_Cgvacia)->with('iPGV',$iTotal_Pgvacia)->with('iCantidad_ahogados',$iCantidad_hogados)->with('iPH',$iPeso_hogados)->with('iTPN', $iTPN)->with('eCantidad_gavetas', $eCantidad_gavetas)->with('ePB', $eTotal_Pbruto)->with('ePeso_gvacia_mollejas', $ePeso_gvacia_mollejas)->with('ePM', $ePeso_mollejas)->with('eTotal_Cgvacia_ahogados',$eTotal_Cgvacia_ahogados)->with('ePeso_gvacia_ahogados_egresos',$ePeso_gvacia_ahogados_egresos)->with('eCantidad_ahogados', $eCantidad_ahogados)->with('ePeso_ahogados', $ePeso_ahogados)->with('eCantidad_gvacias', $eCantidad_gvacias)->with('ePGV', $eTotal_Pgvacias)->with('eTPN', $eTPN)->with('eCantidad_gvacia_estropeados', $eCantidad_gvacia_estropeados)->with('ePeso_gvacia_estropeados', $ePeso_gvacia_estropeados)->with('eCantidad_estropeados', $eCantidad_estropeados)->with('ePE', $ePeso_estropeados)->with('eTD', $eTD)->with('ieTN',$ieTN)->with('iePU', $iePU)->with('ieMA', $ieMA)->with('liquidado', $est_liquidado);
	  	 

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
            	$event->sheet->getStyle('A1:A8')->ApplyFromArray($FuenteLetra);

            	// Color titulos - INGRESOS
                $event->sheet->getStyle('A9:B9')->ApplyFromArray($iColorFondo);

                // Color titulos - EGRESOS
                $event->sheet->getStyle('D9:J9')->ApplyFromArray($iColorFondo);

                //cuadricula - INGRESOS
                $event->sheet->getStyle('A10:B19')->ApplyFromArray($borderMedium);

                //cuadricula - EGRESOS
                $event->sheet->getStyle('D10:E19')->ApplyFromArray($borderMedium);
                $event->sheet->getStyle('G10:J16')->ApplyFromArray($borderMedium);

                //TITULOS SECUNDARIOS INGRESOS - EGRESOS
                $event->sheet->getStyle('A10:J10')->ApplyFromArray($FuenteLetra);
                $event->sheet->getStyle('A13:J13')->ApplyFromArray($FuenteLetra);
                $event->sheet->getStyle('A16:J16')->ApplyFromArray($FuenteLetra);

                //SUBTITULOS INGRESOS - EGRESOS
                $event->sheet->getStyle('A11:B11')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('D11:E11')->ApplyFromArray($eColorFondo);
                $event->sheet->getStyle('G11:J11')->ApplyFromArray($eColorFondo);

                $event->sheet->getStyle('A14:B14')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('D14:E14')->ApplyFromArray($eColorFondo);
                $event->sheet->getStyle('G14:J14')->ApplyFromArray($eColorFondo);

                $event->sheet->getStyle('A17:B17')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('D17:E17')->ApplyFromArray($eColorFondo);



                $event->sheet->getStyle('G16:J16')->ApplyFromArray($TColorFondo);
                $event->sheet->getStyle('A19:B19')->ApplyFromArray($TColorFondo);
                $event->sheet->getStyle('D19:E19')->ApplyFromArray($TColorFondo);

                $event->sheet->getStyle('A21:B21')->ApplyFromArray($TNColorFondo);


            }
        ];


     }

     public function columnFormats(): array {

        return [
                'A'=>NumberFormat::FORMAT_NUMBER,
            ];

    }

}