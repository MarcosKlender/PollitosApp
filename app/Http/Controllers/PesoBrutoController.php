<?php

namespace App\Http\Controllers;

use App\Lotes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesoBrutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $lotes = Lotes::orderBy('id')->paginate(8);
        $count = count(Lotes::all());
        
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
        //
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
        //
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
}
