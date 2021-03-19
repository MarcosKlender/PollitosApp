<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Visceras;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViscerasController extends Controller
{
    public function index()
    {
        if (Auth::user()->rol_id == 1) {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->paginate(8);
        } else {
            $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 0)->where('usuario', Auth::user()->username)->paginate(8);
        }

        $count = count($lotes);
        
        return view('visceras.index', compact('lotes', 'count'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $lote = Lotes::findOrFail($id);
        $visceras = Visceras::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        $total_bruto = Visceras::where('lotes_id', $id)->where('anulado', 0)->select('peso_bruto')->sum('peso_bruto');
        $total_gavetas = Visceras::where('lotes_id', $id)->where('anulado', 0)->select('peso_gavetas')->sum('peso_gavetas');
        $total_final = Visceras::where('lotes_id', $id)->where('anulado', 0)->select('peso_final')->sum('peso_final');

        return view('visceras.show', compact('lote', 'visceras', 'total_bruto', 'total_gavetas', 'total_final'));
    }

    public function edit($id)
    {
        $lote = Lotes::findOrFail($id);
        $visceras = Visceras::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        return view('visceras.edit', compact('lote', 'visceras'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $updateData = $request->validate([
            'lotes_id' => 'required|numeric',
            'tipo' => 'required|max:8',
            'peso_bruto' => 'required|numeric|min:1',
            'peso_gavetas' => '',
            'peso_final' => '',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);
        
        Visceras::whereId($id)->create($updateData);

        $lote = Lotes::findOrFail($id);

        return redirect()->route('visceras.edit', $id)->with('lote');
    }

    public function destroy($id)
    {
        //
    }

    public function registros_anulados()
    {
        $visceras = Visceras::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($visceras);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/visceras');
        }
        
        return view('visceras.registros_anulados', compact('visceras', 'count'));
    }

    public function anular_registro(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        Visceras::whereId($request->id_anular)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!');
    }

    public function registrar_gavetas(Request $request)
    {
        $updateData = $request->validate([
            'peso_gavetas' => 'required|numeric|min:1',
            'peso_final' => 'required|numeric'
        ]);
        
        Visceras::whereId($request->id_gavetas)->update($updateData);

        return back()->with('success', '¡El peso de las gavetas fue registrado exitosamente!');
    }

    public function liquidar_lote(Request $request)
    {
        $updateData = $request->validate([
            'visceras' => 'required|size:1',
        ]);
        
        Lotes::whereId($request->id_liquidar)->update($updateData);

        return redirect('/visceras')->with('success', '¡Lote liquidado exitosamente!');
    }
}
