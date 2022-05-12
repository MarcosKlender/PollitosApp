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
use App\Exports\PostExportEntregaConsolidadoGeneral;

class PostExportEntregaConsolidadoGeneral implements FromView, WithTitle, WithEvents, WithColumnFormatting
{
	use Exportable;

    protected $id;

    public function __construct($fechaini = null, $fechafin = null, $entregas = null ,$eCantidad_gavetas = null, $ePeso_bruto = null, $Total_cgaveta_presas = null, $Total_pbruto_presas = null, $categoria_animal = null ,  $grupo_presas = null)
    {
        $this->fechaini = $fechaini;
        $this->fechafin = $fechafin;
        $this->entregas = $entregas;
        $this->eCantidad_gavetas = $eCantidad_gavetas;
        $this->ePeso_bruto = $ePeso_bruto;
        $this->Total_cgaveta_presas = $Total_cgaveta_presas;
        $this->Total_pbruto_presas = $Total_pbruto_presas;
        $this->categoria_animal = $categoria_animal;
        $this->Grupo_presas = $grupo_presas;
    }

    public function view(): View
    {
       $fechaini =$this->fechaini;
       $fechafin = $this->fechafin;

       //dd($fechaini);

       $datoid = Entregas::whereDate('created_at', '>=', [$fechaini])->whereDate('created_at','<=', [$fechafin])->orderBy('id','desc')->select('id')->value('id');

       $this->entregas = Entregas::whereDate('created_at', '>=', [$fechaini])->whereDate('created_at','<=', [$fechafin])->orderBy('id', 'desc')->get();


        //$registros = RegistrosEntregas::where('entregas_id', $datoid)->orderBy('entregas_id', 'desc')->get();


        $this->eCantidad_gavetas = RegistrosEntregas::where('anulado', 0)->selectRaw('entregas_id, SUM(cant_gavetas) as cant_gavetas')->orderBy('entregas_id', 'desc')->groupBy('entregas_id')->get();


        $this->ePeso_bruto = RegistrosEntregas::where('anulado', 0)->selectRaw('entregas_id, SUM(peso_bruto) as peso_bruto')->orderBy('entregas_id', 'desc')->groupBy('entregas_id')->get();


        $this->Total_cgaveta_presas = PresasEntregas::where('anulado',0)->selectRaw('entregas_id, SUM(cant_gavetas) as cant_gavetas, SUM(peso_bruto) as peso_bruto')->orderBy('entregas_id','desc')->groupBy('entregas_id')->get();


        $this->Total_pbruto_presas = PresasEntregas::where('anulado',0)->selectRaw('entregas_id, SUM(peso_bruto) as peso_bruto')->orderBy('entregas_id','desc')->groupBy('entregas_id')->get();


       $this->Grupo_presas = PresasEntregas::where('anulado',0)->selectRaw('entregas_id, tipo_entrega, SUM(cant_gavetas) as cant_gavetas, SUM(peso_bruto) as peso_bruto')->orderBy('entregas_id','desc')->groupBy('entregas_id','tipo_entrega')->get();

        $this->categoria_animal = RegistrosEntregas::where('anulado', 0)->selectRaw('entregas_id, categoria_animales, SUM(cant_gavetas) as cant_gavetas')->orderBy('entregas_id','desc')->groupBy('entregas_id', 'categoria_animales')->get();

    
       //$TPN = $ePeso_bruto + $Total_pbruto_presas;


        $anulado = Entregas::where('id',$datoid)->orderBy('id','desc')->select('anulado')->value('anulado');

        $liquidado = Entregas::where('id',$datoid)->orderBy('id','desc')->select('liquidado')->value('liquidado');

        if($anulado != '1') {
            if($liquidado === '1') {$est_liquidado = 'Liquidado';}else{$est_liquidado = 'Abierto'; }  
        }else{
            $est_liquidado = 'Anulado';
        }

        return view('reportesentregas.excelviews.entregaconsolidadogeneralexcel',['entregas',$this->entregas])->with('entregas', $this->entregas)->with('id', $datoid)->with('eCantidad_gavetas', $this->eCantidad_gavetas)->with('PB',$this->ePeso_bruto)->with('PP', $this->Total_pbruto_presas)->with('Total_cgaveta_presas', $this->Total_cgaveta_presas)->with('grupo_presas', $this->Grupo_presas)->with('categoria_animal', $this->categoria_animal)->with('liquidado', $est_liquidado);

    }

    public function title():string {
        return 'Consolidado General';

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
                $CeldaPresas = null;
                //$fila_inicial = 15; 
                $cantidad_filas = count($this->Grupo_presas);


                
                $Celda_hasta = null;
                $fila_inicial = 10;
                $letra_columna = 3; //columna "C"
                $numero_fila = 10; // fila "9"
                $acumulador = 0;

                // Captura de la celda inicial 
                 $Celda_hasta = $event->sheet->getCellByColumnAndRow($letra_columna, $numero_fila)->getParent()->getCurrentCoordinate();


                foreach($this->entregas as $entrega){

                    foreach( $this->eCantidad_gavetas as $eCantidad_gaveta ){

                        if( $eCantidad_gaveta->entregas_id == $entrega->id ){                       

                                //Cuadriculas
                                $event->sheet->getStyle('A'.$fila_inicial.':'.$Celda_hasta)->ApplyFromArray($borderMedium);

                                $acumulador = $acumulador + 1;


                       }
                    }           

                }





                //Cuadriculas
                /*$event->sheet->getStyle('A10:C12')->ApplyFromArray($borderMedium);

                //Color celdas
                $event->sheet->getStyle('A10:A12')->ApplyFromArray($iColorFondo2);
                $event->sheet->getStyle('A14:C14')->ApplyFromArray($iColorFondo2);


                $posicion_tpresas = ($fila_inicial + $cantidad_filas); 
                $CeldaPresas = $event->sheet
                    ->getCellByColumnAndRow(3, $fila_inicial + $cantidad_filas)
                    ->getParent()
                    ->getCurrentCoordinate();

                $event->sheet->getStyle('A14:'.$CeldaPresas)->ApplyFromArray($borderMedium);
                $event->sheet->getStyle('A'.$posicion_tpresas.':C'.$posicion_tpresas)->ApplyFromArray($iColorFondo);


                //TOTAL - FILA FINAL
                $posicion_fila = ($fila_inicial + $cantidad_filas) + 2; 
                $event->sheet->getStyle('A'.$posicion_fila.':C'.$posicion_fila)->ApplyFromArray($borderMedium);
                $event->sheet->getStyle('A'.$posicion_fila.':C'.$posicion_fila)->ApplyFromArray($iColorFondo3);*/



            }
        ];


     }

    public function columnFormats(): array {

        return [
                'B'=>NumberFormat::FORMAT_NUMBER,
            ];

    }



}


