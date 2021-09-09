<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
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
        //dd($request->get("ruc_ci"));
        $storeData = $request->validate([
            //'tipo' => 'required|max:3',
            'pro_ruc' => 'required|unique:proveedores,pro_ruc|digits_between:10,13',
            'pro_nombre' => 'required|max:191',
            'pro_nombre_comercial' => 'required|max:191',
            'pro_direccion' => 'required|max:191',
            'pro_telefonos' => 'required|digits_between:7,10',
            'pro_email' => 'required|email|unique:proveedores,pro_email|max:191',
        ]);

        $proveedor = Proveedores::create($storeData);

        // Mantener datos del formulario
        $request->old('pro_ruc');
        $request->old('pro_nombre');
        $request->old('pro_nombre_comercial');
        $request->old('pro_telefonos');
        $request->old('pro_email');
        $request->old('pro_direccion');

        return redirect('/proveedores')->with('success', '¡Proveedor creado exitosamente!');
    }

    public function show(Request $request)
    {

        $criterio_ruc_ci = $request->get('criterio_ruc_ci');
        $criterio_nombres = $request->get('criterio_nombres');
        $criterio_rsocial = $request->get('criterio_rsocial');
        //$criterio_ciudad = $request->get('criterio_ciudad');

        $searches = Proveedores::orderBy('id')
            ->ruc_ci($criterio_ruc_ci)
            ->nombre($criterio_nombres)
            ->razonsocial($criterio_rsocial)
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
            'pro_ruc' => 'required|digits_between:10,13|unique:proveedores,pro_ruc,'.$id,
            'pro_nombre' => 'required|max:191',
            'pro_nombre_comercial' => 'required|max:191',
            'pro_direccion' => 'required|max:191',
            'pro_telefonos' => 'required|digits_between:7,10',
            'pro_email' => 'required|email|max:191|unique:proveedores,pro_email,'.$id,
        ]);

        Proveedores::whereId($id)->update($updateData);

        return redirect('/proveedores')->with('success', '¡Proveedor actualizado exitosamente!');
    }

    public function destroy($id)
    {
        //
    }
}
