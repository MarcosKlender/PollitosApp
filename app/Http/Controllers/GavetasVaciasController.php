<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\GavetasVacias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GavetasVaciasController extends Controller
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
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);
        
        GavetasVacias::whereId($id)->create($updateData);

        $lote = Lotes::findOrFail($id);
        $tab = $request->get('tab');

        return redirect()->route('pesobruto.edit', $id)->with('lote')->with('tab');
    }

    public function anular(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        GavetasVacias::whereId($request->id_anular_gavetas)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!');
    }
}
