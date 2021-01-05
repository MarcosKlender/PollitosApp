<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Registros;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PesoBrutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $lotes = Lotes::orderBy('id')->where('anulado', 0)->paginate(8);
        $count = count($lotes);
        
        return view('pesobruto.index', compact('lotes', 'count'));
    }

    public function create()
    {
        return view('pesobruto.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'tipo' => 'required|max:7',
            'proveedor' => 'required|max:191',
            'procedencia' => 'required|max:191',
            'placa' => 'required|size:7',
            'conductor' => 'required|max:191',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);

        $lotes = Lotes::create($storeData);

        // Mantener datos del formulario
        $request->old('proveedor');
        $request->old('procedencia');
        $request->old('placa');
        $request->old('conductor');

        return redirect('/pesobruto')->with('success', '¡Lote creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lote = Lotes::findOrFail($id);
        $registros = Registros::where('lotes_id', $id)->where('anulado', 0)->orderBy('id')->get();

        return view('pesobruto.edit', compact('lote', 'registros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'lotes_id' => 'required|numeric',
            'cant_gavetas' => 'required|numeric',
            'cant_pollos' => '',
            'peso_gavetas_pollos' => 'required|numeric',
            'peso_gavetas' => 'required|numeric',
            'peso_final' => 'required|numeric',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);
        
        Registros::whereId($id)->create($updateData);

        $lote = Lotes::findOrFail($id);

        return redirect()->route('pesobruto.edit', $id)->with('lote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function lotes_anulados()
    {
        $lotes = Lotes::orderBy('id', 'desc')->where('anulado', 1)->paginate(8);
        $count = count($lotes);

        if (Auth::user()->rol->key != 'admin')
        {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.lotes_anulados', compact('lotes', 'count'));
    }

    public function anular_lote(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
        ]);
        
        Lotes::whereId($request->id)->update($updateData);

        return back()->with('success', '¡Lote actualizado exitosamente!');
    }

    public function registros_anulados()
    {
        $registros = Registros::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($registros);

        if (Auth::user()->rol->key != 'admin')
        {
            return redirect('/pesobruto');
        }
        
        return view('pesobruto.registros_anulados', compact('registros', 'count'));
    }

    public function anular_registro(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
        ]);
        
        Registros::whereId($request->id)->update($updateData);

        return back()->with('success', '¡El registro ha sido anulado!');
    }
}
