<?php

namespace App\Http\Controllers;

use App\Entregas;
use App\PresasEntregas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresasEntregasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'entregas_id' => 'required|numeric',
            'tipo_entrega' => 'required|max:30',
            'cant_gavetas' => 'required|numeric|min:0',
            'tipo_peso' => 'required|size:2',
            'peso_bruto' => 'required|numeric|min:1',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);
        
        PresasEntregas::whereId($id)->create($updateData);

        $entregas = Entregas::findOrFail($id);

        return redirect()->route('entregas.edit', $id)->with('entregas')->with('usedTab', 'gavetas');
    }

    public function anular(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        PresasEntregas::whereId($request->id_anular_gavetas)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!')->with('usedTab', 'gavetas');
    }
}
