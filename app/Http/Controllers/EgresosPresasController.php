<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Egresos;
use App\EgresosPresas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EgresosPresasController extends Controller
{

	   public function liquidar_lote_egresos(Request $request)
        {

        $estado_liquidado = Lotes::where('id', $request->lotes_id)->where('anulado', 0)->select('liquidado')->value('liquidado');
        
        if ($estado_liquidado === '1') {
            
            Lotes::whereId($request->lotes_id)
                ->update(['estado_egresos' => $request->estado_egresos ,
                          'cant_animales_egresos'=> $request->cant_animales_egresos ] );
            
            return redirect('/egresos')->with('success', '¡Lote liquidado exitosamente!');
        } else {
            return redirect('/egresos')->with('error', '¡Revisar que lote de ingresos este liquidado!');
        }
    }


    public function desechos_lote_egresos(Request $request)
        {

        $storeEgresosPresas = $request->validate([
             'estado_egreso_presas' => 'required|size:1',
      //      'liquidado' => 'required|size:1',
            'lotes_id' => 'required|numeric',
            'cant_ahogados_egresos' => 'required|numeric',
            'peso_ahogados_egresos' => 'required|numeric',
            'cant_gvacia_ahogados_egresos' => 'required|numeric',
            'peso_gvacia_ahogados_egresos' => 'required|numeric',
            'cant_estropeados_egresos' => 'required|numeric',
            'peso_estropeados_egresos' => 'required|numeric',
            'cant_gvacia_estropeados_egresos' => 'required|numeric',
            'peso_gvacia_estropeados_egresos' => 'required|numeric',
            'peso_mollejas_egresos' => 'required|numeric',
            //'cant_gvacia_mollejas_egresos' => 'required|numeric',
            'peso_gvacia_mollejas_egresos' => 'required|numeric',
            'usuario_creacion' => 'required|max:191',
        ]);


        
            $existe_egresos_presas = EgresosPresas::where('lotes_id', $request->lotes_id)->get();

            $count_egresos = count($existe_egresos_presas);

            if($count_egresos === 1){
                Lotes::whereId($request->lotes_id)
                    ->update(['estado_egresos' => $request->estado_egresos ,
                              'cant_animales_egresos'=> $request->cant_animales_egresos ] );

                EgresosPresas::where('lotes_id', $request->lotes_id)
                    ->update($storeEgresosPresas);

                return back()->with('success', '¡Desechos registrados exitosamente!');


            }elseif($count_egresos === 0){ 

                EgresosPresas::create($storeEgresosPresas);
                return back()->with('success', '¡Desechos registrados exitosamente!');

            }
    }

    public function detalle_desechos()
    {
        $id = Request()->id;
        $egresos_presas = EgresosPresas::where('lotes_id', $id)->orderBy('id')->get();
        return $egresos_presas;
    }

}
