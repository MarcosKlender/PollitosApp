<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'rol']);
    }

    public function index()
    {
        $proveedores = Proveedores::orderBy('id')->paginate(10);
        $count = count(Proveedores::all());
        
        return view('proveedores.index', compact('proveedores', 'count'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'tipo' => 'required|max:3',
            'ruc_ci' => 'required|unique:proveedores,ruc_ci|digits_between:10,13',
            'nombres' => 'required|max:191',
            'razon_social' => 'required|max:191',
            'direccion' => 'required|max:191',
            'telefono' => 'required|digits_between:7,9',
            'movil' => 'required|digits:10',
            'email' => 'required|email|unique:proveedores,email|max:191',
            'provincia' => 'required|max:191',
            'ciudad' => 'required|max:191',
            'parroquia' => 'required|max:191',
        ]);

        $proveedor = Proveedores::create($storeData);

        // Mantener datos del formulario
        $request->old('ruc_ci');
        $request->old('nombres');
        $request->old('razon_social');
        $request->old('direccion');
        $request->old('telefono');
        $request->old('movil');
        $request->old('email');
        $request->old('provincia');
        $request->old('ciudad');
        $request->old('parroquia');

        return redirect('/proveedores')->with('success', '¡Proveedor creado exitosamente!');
    }

    public function show(Request $request)
    {

        $criterio_ruc_ci = $request->get('criterio_ruc_ci');
        $criterio_nombres = $request->get('criterio_nombres');
        $criterio_rsocial = $request->get('criterio_rsocial');
        $criterio_ciudad = $request->get('criterio_ciudad');

        $searches = Proveedores::orderBy('id')
            ->ruc_ci($criterio_ruc_ci)
            ->nombre($criterio_nombres)
            ->razonsocial($criterio_rsocial)
            ->ciudad($criterio_ciudad)
            ->paginate(10);

        $count = count($searches);

        /*if ($tipo_busqueda == 'ruc_ci')
        {
            $searches = Proveedores::orderBy('id')->where('ruc_ci', 'like', '%'.$criterio.'%')->paginate(10);
            $count = count($searches);
        }
        elseif ($tipo_busqueda == 'nom_rs')
        {
            $searches = Proveedores::orderBy('id')->where('nombres', 'like', '%'.$criterio.'%')->orWhere('razon_social', 'like', '%'.$criterio.'%')->paginate(10);
            $count = count($searches);
        }*/

        return view('proveedores.search', compact('searches', 'count'));
    }

    public function edit($id)
    {
        $proveedor = Proveedores::findOrFail($id);

        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'tipo' => 'required|max:3',
            'ruc_ci' => 'required|digits_between:10,13|unique:proveedores,ruc_ci,'.$id,
            'nombres' => 'required|max:191',
            'razon_social' => 'required|max:191',
            'direccion' => 'required|max:191',
            'telefono' => 'required|digits_between:7,9',
            'movil' => 'required|digits:10',
            'email' => 'required|email|max:191|unique:proveedores,email,'.$id,
            'provincia' => 'required|max:191',
            'ciudad' => 'required|max:191',
            'parroquia' => 'required|max:191',
        ]);

        Proveedores::whereId($id)->update($updateData);

        return redirect('/proveedores')->with('success', '¡Proveedor actualizado exitosamente!');
    }

    public function destroy($id)
    {
        //
    }
}
