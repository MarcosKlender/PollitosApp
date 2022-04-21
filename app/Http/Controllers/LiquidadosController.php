<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Entregas;
use Illuminate\Http\Request;

class LiquidadosController extends Controller
{
    public function index()
    {
        $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->paginate(8);
        $count_ingresos = count($lotes);

        $entregas = Entregas::orderBy('id', 'desc')->where('anulado', 0)->paginate(10);
        $count_entregas = count($entregas);
        
        return view('liquidados.index', compact('lotes', 'count_ingresos', 'entregas', 'count_entregas'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'liquidado'  => 'nullable|size:1',
        ]);

        Lotes::whereId($id)->update($updateData);

        return back()->with('success', '¡Lote actualizado exitosamente!');
    }

    public function update2(Request $request, $id)
    {
        $updateData = $request->validate([
            'estado_egresos'  => 'nullable|size:1' 
        ]);

        Lotes::whereId($id)->update($updateData);

        return back()->with('success', '¡Lote actualizado exitosamente!')->with('usedTab', 'nav-profile');
    }

    public function update3(Request $request, $id)
    {
        $updateData = $request->validate([
            'liquidado'  => 'nullable|size:1'
        ]);

        Entregas::whereId($id)->update($updateData);

        return back()->with('success', '¡Lote actualizado exitosamente!')->with('usedTab', 'nav-contact');
    }
}
