<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\GavetasVaciasEgresos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GavetasVaciasEgresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'lotes_id' => 'required|numeric',
            'cant_gavetas_vacias' => 'required|numeric|min:1',
            'peso_gavetas_vacias' => 'required|numeric|min:1',
            'tipo_peso' => 'required|size:2',
            'usuario_creacion' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);
        
        GavetasVaciasEgresos::whereId($id)->create($updateData);

        $lote = Lotes::findOrFail($id);

        return redirect()->route('egresos.edit', $id)->with('lote')->with('usedTab', 'gavetas');
    }

    public function anular(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        GavetasVaciasEgresos::whereId($request->id_anular_gavetas)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!')->with('usedTab', 'gavetas');
    }
}
