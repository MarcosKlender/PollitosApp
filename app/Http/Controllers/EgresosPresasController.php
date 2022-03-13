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
    	//dd($request->all());

        $storeEgresosPresas = $request->validate([
        //    'egresos' => 'required|size:1',
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
            'estado_egreso_presas' =>'required|size:1',

        ]);


        $estado_liquidado = Lotes::where('id', $request->lotes_id)->where('anulado', 0)->select('liquidado')->value('liquidado');
        
        if ($estado_liquidado === '1') {
            
            Lotes::whereId($request->lotes_id)
                ->update(['estado_egresos' => $request->estado_egresos ,
                          'cant_animales_egresos'=> $request->cant_animales_egresos ] );
            
            EgresosPresas::create($storeEgresosPresas);

            return redirect('/egresos')->with('success', '¡Lote liquidado exitosamente!');
        } else {
            return redirect('/egresos')->with('error', '¡Revisar que lote de ingresos este liquidado!');
        }
    }



   
}
