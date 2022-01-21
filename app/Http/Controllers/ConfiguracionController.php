<?php

namespace App\Http\Controllers;

use App\Configuracion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'rol']);
    }

    public function index()
    {
        $configuracion = Configuracion::orderBy('id')->paginate(10);
        $count = count(Configuracion::all());

        return view('configuracion.index', compact('configuracion', 'count'));
    }

    public function create()
    {
        return view('configuracion.create');
    }

    public function store(Request $request)
    {
        $configuracion = Configuracion::create($request->all());

        return redirect()->route('configuracion.index');
    }

    public function edit($id)
    {
        $configuracion = Configuracion::findOrFail($id);

        return view('configuracion.edit', compact('configuracion'));
    }


    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'mod_conf' =>'required|max:15',
            'des_conf'=>'required|max:200',
            'ele_conf'=> 'required|max:50',
            'val_conf'=>'required|max:10',
            'est_conf'=>'required|max:1'
        ]);

        Configuracion::whereId($id)->update($updateData);

        return redirect('/configuracion')->with('success', '¡Configuración actualizada exitosamente!');
    }

    public function show(Request $request)
    {
        $criterio_modulo = $request->get('criterio_modulo');
        $criterio_descripcion = $request->get('criterio_descripcion');

        $searches = Configuracion::orderBy('id')
            ->modulo($criterio_modulo)
            ->descripcion($criterio_descripcion)
            ->paginate(10);

        $count = count($searches);

        return view('configuracion.search', compact('searches', 'count'));
    }
}
