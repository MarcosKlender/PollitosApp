<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index(){
    	$clientes = Clientes::orderBy('id')->paginate(10);
        $count = count(Clientes::all());
        
        return view('clientes.index', compact('clientes', 'count'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'tipo' => 'required|max:3',
            'ruc_ci' => 'required|digits_between:10,13|unique:clientes,ruc_ci',
            'nombres' => 'required|max:191',
            'razon_social' => 'nullable|max:191',
            'direccion' => 'nullable|max:191',
            'telefono' => 'nullable|digits_between:7,10',
            'movil' => 'nullable|digits_between:7,10',
            'email' => 'nullable|email|max:191|unique:clientes,email',
            'provincia' => 'nullable|max:191',
            'ciudad' => 'nullable|max:191',
            'parroquia' => 'nullable|max:191',
        ]);

        $cliente = Clientes::create($storeData);

        // Mantener datos del formulario
        $request->old('tipo');
        $request->old('ruc_ci');
        $request->old('nombres');
        $request->old('razon_social');
        $request->old('direccion');
        $request->old('telefono');
        $request->old('email');
        $request->old('provincia');
        $request->old('ciudad');
        $request->old('parroquia');

        return redirect('/clientes')->with('success', '¡Cliente creado exitosamente!');
    }

    public function show(Request $request){
    	$criterio_ruc_ci = $request->get('criterio_ruc_ci');
        $criterio_nombres = $request->get('criterio_nombres');
        $criterio_rsocial = $request->get('criterio_rsocial');
        $criterio_ciudad = $request->get('criterio_ciudad');

        $searches = Clientes::orderBy('id')
            ->ruc_ci($criterio_ruc_ci)
            ->nombre($criterio_nombres)
            ->razonsocial($criterio_rsocial)
            ->ciudad($criterio_ciudad)
            ->paginate(10);

        $count = count($searches);

        return view('clientes.search', compact('searches', 'count'));
    }

    public function edit($id)
    {
        $cliente = Clientes::findOrFail($id);

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'tipo' => 'required|max:3',
            'ruc_ci' => 'required|digits_between:10,13|unique:clientes,ruc_ci,'.$id,
            'nombres' => 'required|max:191',
            'razon_social' => 'nullable|max:191',
            'direccion' => 'nullable|max:191',
            'telefono' => 'nullable|digits_between:7,10',
            'movil' => 'nullable|digits_between:7,10',
            'email' => 'nullable|email|max:191|unique:clientes,email,'.$id,
            'provincia' => 'nullable|max:191',
            'ciudad' => 'nullable|max:191',
            'parroquia' => 'nullable|max:191',
        ]);

        Clientes::whereId($id)->update($updateData);

        return redirect('/clientes')->with('success', '¡Cliente actualizado exitosamente!');
    }

}
