<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\BasculaConfiguracion;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BasculaConfiguracionStoreRequest;

class BasculaConfiguracionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'rol']);
    }

    public function index()
    {
        $datos['basculas'] = BasculaConfiguracion::orderBy('id', 'asc')->paginate(5);

        return view('basculaconfiguracion.index', $datos);
    }

    public function store(BasculaConfiguracionStoreRequest $request)
    {
        $max = BasculaConfiguracion::count('id');
        $codigo =  'B00-' . ($max + 1);

        $bascula = BasculaConfiguracion::create([
            'cod_bascula' => $codigo,
            'nom_bascula' => $request->nom_bascula,
            'ipx_bascula' => $request->ipx_bascula,
            'est_bascula' => $request->est_bascula,
            'usuario_creacion' => $request->usuario_creacion,
            ]);

        return redirect()->route('basculaconfiguracion.index')->with('success', '¡Báscula creada exitosamente!');
    }

    public function edit($id)
    {
        $editar = BasculaConfiguracion::findOrFail($id);

        return view('basculaconfiguracion.edit', compact('editar'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'cod_bascula' => 'required',
            'nom_bascula' => 'required',
            'ipx_bascula' => 'required',
            'est_bascula' => 'required'
        ]);

        BasculaConfiguracion::whereId($id)->update($updateData);

        return redirect('/basculaconfiguracion')->with('success', '¡Báscula actualizada exitosamente!');
    }

    public function destroy($id_basc)
    {
        BasculaConfiguracion::destroy($id_basc);
        return redirect('basculaconfiguracion');
    }
}
