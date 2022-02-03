<?php
namespace App\Exports;
use App\Registros;
//use App\Visceras;
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
use App\Exports\PostsExport;

class PostsExport implements FromView, WithTitle, WithColumnFormatting, WithEvents, WithMultipleSheets
{
	use Exportable;

    protected $id;

    public function __construct($id = null, $gavetas_vacias = null, $ingresos = null, $animales_ahogados = null, $registro_faenados = null, $gavetas_vacias_egresos = null )
    {
        $this->id = $id;
        $this->gavetas_vacias = $gavetas_vacias;
        $this->ingresos = $ingresos;
        $this->animales_ahogados = $animales_ahogados;
        $this->registro_faenados = $registro_faenados;
        $this->gavetas_vacias_egresos = $gavetas_vacias_egresos;

    }

    public function view(): View
    {
       $datoid=$this->id;

        $total_cantidad = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');
        
        $total_bruto = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        
        $total_gavetas = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');
        $total_final = Registros::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_final')->sum('peso_final');


        $totale_cantidad = Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas')->sum('cant_gavetas');

        $totale_bruto =    Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        
        $totale_gavetas =  Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');

        $totale_final =    Egresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        $total_can_gav_vacia = GavetasVacias::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');
        
        $total_pes_gav_vacia = GavetasVacias::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');

        $total_can_gav_vacia_egreso = GavetasVaciasEgresos::where('lotes_id', $datoid)->where('anulado', 0)->select('cant_gavetas_vacias')->sum('cant_gavetas_vacias');

        $total_pes_gav_vacia_egreso = GavetasVaciasEgresos::where('lotes_id', $datoid)->where('anulado', 0)->select('peso_gavetas_vacias')->sum('peso_gavetas_vacias');


        $this->ingresos = Registros::where('lotes_id', $this->id)->where('anulado', 0)->get();

        $this->gavetas_vacias = GavetasVacias::where('lotes_id', $this->id)->where('anulado', 0)->get();

        $this->animales_ahogados = Lotes::where('id', $this->id)->where('anulado', 0)->get();

        $this->registro_faenados = Egresos::where('lotes_id', $this->id)->where('anulado', 0)->get();

        $this->gavetas_vacias_egresos = GavetasVaciasEgresos::where('lotes_id', $this->id)->where('anulado', 0)->get();

        $egresos=   Egresos::where('lotes_id', $this->id)->where('anulado',0)->get();

        $anulado = Lotes::where('id',$datoid)->select('anulado')->value('anulado');
        $liquidado = Lotes::where('id',$datoid)->select('liquidado')->value('liquidado');

        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }

        return view('reportes.excelviews.lotdetexcel',[ 'lotes' => Lotes::where('id', $this->id)->get()],['registros' => Registros::where('lotes_id', $this->id)->get()])->with('id',$datoid)->with('total_cantidad',$total_cantidad)->with('total_bruto',$total_bruto)->with('total_gavetas',$total_gavetas)->with('total_final',$total_final)->with('totale_cantidad',$totale_cantidad)->with('totale_bruto',$totale_bruto)->with('totale_gavetas',$totale_gavetas)->with('totale_final',$totale_final)->with('gavetas_vacias',$this->gavetas_vacias)->with('gavetas_vacias_egresos',$this->gavetas_vacias_egresos)->with('total_can_gav_vacia',$total_can_gav_vacia)->with('total_pes_gav_vacia',$total_pes_gav_vacia)->with('total_can_gav_vacia_egreso',$total_can_gav_vacia_egreso)->with('total_pes_gav_vacia_egreso',$total_pes_gav_vacia_egreso)->with('egresos',$egresos)->with('liquidado',$est_liquidado);


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

        $colorFondo = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'FBEC3C')
            )
        ];

        /*$fonNetgrita = [
            'font' => [
                'bold' => true,
                'size' => 12
            ]

        ];*/

        return [
            AfterSheet::class => function(AfterSheet $event) use ($borderMedium, $colCenter, $colorFondo)
            {
                
                $iCeldaRegistroAnimales = null;
                $iCeldaRegistrogvacias = null;
                $iCeldaAnimalesAhogados = null;
                $eCeldaAnimalesEstropeados = null;
                $eCeldaMollejas = null;
                $eCedldaAnimalesFaenados = null;
                $iCeldaTituloEgreso = null;

                // combinar celdas
               /* $event->sheet->getDelegate()->setMergeCells(
                    ['A1:D1', 'A8:D8', 'A12:D12']
                );*/

                // Color titulos - INGRESOS
                $event->sheet->getStyle('A8:D8')->ApplyFromArray($colorFondo);

                
                $event->sheet->getStyle('A13:E14')->ApplyFromArray($borderMedium); //Registro animales vivos - titulo INGRESOS
                $event->sheet->getStyle('A13:E13')->ApplyFromArray($colCenter); //Registro animales vivos - titulo INGRESOS

                $event->sheet->getStyle('A9:D11')->ApplyFromArray($borderMedium); //Cantidad ahogados - Titulo INGRESOS 
                $event->sheet->getStyle('A9:D9')->ApplyFromArray($colCenter); //Cantidad ahogados - Titulo INGRESOS 
                

                

                //Registro animales vivos - INGRESOS
                $i = 15;
                $contador_ing = 0;

                if( count($this->ingresos) > 0){

                    foreach($this->ingresos as $ingreso){  
                        $iCeldaRegistroAnimales = $event->sheet->getCellByColumnAndRow(5, $i+1)->getParent()->getCurrentCoordinate();
                        $i++;
                        $contador_ing = $i;
                    }
                 $event->sheet->getStyle('A15:'.$iCeldaRegistroAnimales )->ApplyFromArray($borderMedium);

                 } 

                 //registro de gavetas vacias - INGRESOS
                $j = $contador_ing + 2;
                $celda_gv = $j;
                $contador_gv=0;

                if( count($this->gavetas_vacias) > 0){

                    foreach($this->gavetas_vacias as $gaveta_vacia){  
                        $iCeldaRegistrogvacias = $event->sheet->getCellByColumnAndRow(5, $j+3)->getParent()->getCurrentCoordinate();
                        $j++;
                        $contador_gv = $j;
                    }  
                     $event->sheet->getStyle('A'.$celda_gv.':'.$iCeldaRegistrogvacias )->ApplyFromArray($borderMedium); 
                }


                 //animales ahogados - EGRESOS
                $h = $contador_gv + 4;
                $celda_ah = $h;

                // Color titulos - EGRESOS
                $iCeldaTituloEgreso = $event->sheet->getCellByColumnAndRow(5, $h)->getParent()->getCurrentCoordinate();

                $iCeldaAnimalesAhogados = $event->sheet->getCellByColumnAndRow(5, $h+3)->getParent()->getCurrentCoordinate();
                
                 // Color titulos - EGRESOS
                $event->sheet->getStyle('A'.$celda_ah.':'.$iCeldaTituloEgreso)->ApplyFromArray($colorFondo);          
                $event->sheet->getStyle('A'.$celda_ah.':'.$iCeldaAnimalesAhogados )->ApplyFromArray($borderMedium); 


                 //animales estropeados -  EGRESOS
                $e = $contador_gv + 9;
                $celda_ah = $e;

                $eCeldaAnimalesEstropeados = $event->sheet->getCellByColumnAndRow(5, $e+2)->getParent()->getCurrentCoordinate();

                $event->sheet->getStyle('A'.$celda_ah.':'.$eCeldaAnimalesEstropeados )->ApplyFromArray($borderMedium); 


                //animales mollejas -  EGRESOS
                $m = $contador_gv + 13;
                $celda_ah = $m;
                $eCeldaMollejas = $event->sheet->getCellByColumnAndRow(4, $m+2)->getParent()->getCurrentCoordinate();

                $event->sheet->getStyle('A'.$celda_ah.':'.$eCeldaMollejas )->ApplyFromArray($borderMedium);
                


                //registro de animales faenados - EGRESOS
                $f = $contador_gv + 17;
                $celda_ah = $f;
                $contador_fa = 0;

                if( count($this->registro_faenados) > 0){

                    foreach( $this->registro_faenados as $registro_faenado)
                    {
                        $eCedldaAnimalesFaenados = $event->sheet->getCellByColumnAndRow(5, $f+3)->getParent()->getCurrentCoordinate();
                        $f++;
                        $contador_fa = $f;
                    }

                    $event->sheet->getStyle('A'.$celda_ah.':'.$eCedldaAnimalesFaenados )->ApplyFromArray($borderMedium);
                }


                //registro de gavetas vacias - EGRESOS
                $gve = $contador_fa + 4;
                $celda_gve = $gve;
                
                if( count($this->gavetas_vacias_egresos) >0 ){

                    foreach( $this->gavetas_vacias_egresos as $gaveta_vacia_egreso)
                    {
                        $eCeldaRegistrogvacias = $event->sheet->getCellByColumnAndRow(5, $gve+3)->getParent()->getCurrentCoordinate();
                        $gve++;
                  
                    }

                    $event->sheet->getStyle('A'.$celda_gve.':'.$eCeldaRegistrogvacias )->ApplyFromArray($borderMedium);
                }




                   
                  

            },
        ];


    }

    public function sheets(): array
    {

        $sheets = [];
        array_push($sheets, new PostsExport($this->id) );
        array_push($sheets, new PostExportLoteConsolidado($this->id) );

        return $sheets;



    }

    public function title():string {
        return 'Detalle Ingresos y Egresos';

    }

   public function columnFormats(): array {

        return [
                'B'=>NumberFormat::FORMAT_NUMBER,
            ];

    }




}


