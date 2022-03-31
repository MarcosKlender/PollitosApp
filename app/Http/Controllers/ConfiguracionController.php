<?php

namespace App\Http\Controllers;

use App\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'rol']);
    }

    public function index()
    {

        if (Auth::user()->rol_id == 1) {
            $configuracion = Configuracion::orderBy('id')->paginate(10);
            $count = count(Configuracion::all());
        } elseif(Auth::user()->rol_id == 2) {
            $configuracion = Configuracion::orderBy('id')->where('mod_conf','INGRESOS')->whereIn('ele_conf',['VALOR_CANT_GAVETAS_LLENAS','VALOR_CANT_GAVETAS_VACIAS'])->paginate(10);
            $count = count(Configuracion::all());
        } elseif(Auth::user()->rol_id == 3) {
            $configuracion = Configuracion::orderBy('id')->where('mod_conf','EGRESOS')->whereIn('ele_conf',['VALOR_CANT_GAVETAS_LLENAS','VALOR_CANT_GAVETAS_VACIAS','VALOR_CANT_ANIMALES'])->paginate(10);
            $count = count(Configuracion::all());
        } elseif(Auth::user()->rol_id == 4) {
            $configuracion = Configuracion::orderBy('id')->where('mod_conf','ENTREGAS')->whereIn('ele_conf',['VALOR_CANT_GAVETAS_LLENAS','VALOR_CANT_GAVETAS_VACIAS'])->paginate(10);
            $count = count(Configuracion::all());
        } elseif(Auth::user()->rol_id == 5) {
            $configuracion = Configuracion::orderBy('id')->whereIn('mod_conf',['EGRESOS','ENTREGAS'])->whereIn('ele_conf',['VALOR_CANT_GAVETAS_LLENAS','VALOR_CANT_GAVETAS_VACIAS','VALOR_CANT_ANIMALES'])->paginate(10);
            $count = count(Configuracion::all());
        }

        return view('configuracion.index', compact('configuracion', 'count'));
    }

    public function create()
    {
        return view('configuracion.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate(
            [
                'mod_conf' => ['required', Rule::unique('configuracion')->where('ele_conf', $request->ele_conf)],
                'des_conf' => 'required|max:200',
                'aut_conf' => 'max:1',
                'ele_conf' => ['required', Rule::unique('configuracion')->where('mod_conf', $request->mod_conf)],
                'val_conf' => 'required|max:10',
                'est_conf' => 'required|max:1',
            ],
            [
                'mod_conf.unique' => 'El elemento ingresado ya existe en ese módulo.',
                'ele_conf.unique' => 'Elija un módulo diferente o cambie el nombre del elemento.',
            ]
        );

        $configuracion = Configuracion::create($storeData);

        return redirect()->route('configuracion.index')->with('success', '¡Configuración creada exitosamente!');
    }

    public function edit($id)
    {
        $configuracion = Configuracion::findOrFail($id);

        return view('configuracion.edit', compact('configuracion'));
    }

    public function update(Request $request, $id)
    {

        /* $updateData2 = $request->validate(
            [
                 'aut_conf' => 'nullable|size:1',
            ]
        );*/


        $updateData = $request->validate(
            [
                'mod_conf' => ['nullable', Rule::unique('configuracion')->where('ele_conf', $request->ele_conf)->ignore($id)],
                'des_conf' => 'nullable|max:200',
                'aut_conf' => 'nullable|size:1',
                'ele_conf' => ['nullable', Rule::unique('configuracion')->where('mod_conf', $request->mod_conf)->ignore($id)],
                'val_conf' => 'nullable|max:10',
                'val2_conf' => 'max:10',
                'est_conf' => 'nullable|max:1',
            ],
            [
                'mod_conf.unique' => 'El elemento ingresado ya existe en ese módulo.',
                'ele_conf.unique' => 'Elija un módulo diferente o cambie el nombre del elemento.',
            ]
        );



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
