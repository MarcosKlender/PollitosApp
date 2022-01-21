<?php

namespace App\Http\Controllers;

use App\BasculaConfiguracion;
use App\Basculas;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BasculaStoreRequest;

class BasculasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'rol']);
    }

    public function index()
    {
        $datos['basculas'] = Basculas::orderBy('id', 'asc')->paginate(5);

        return view('basculas.index', $datos);
    }

    public function store(BasculaStoreRequest $request)
    {
        $bascula = Basculas::create($request->all());

        return redirect()->route('basculas.index');
    }

    public function selectSearch(Request $request)
    {
        $user = [];

        if ($request->has('q')) {
            $search = $request->q;
            $usuario =user::select("username")
                    ->where('username', 'iLIKE', "%$search%")
                    ->get();
        }

        return response()->json($usuario);
    }

    public function selectSearchBascula(Request $request)
    {
        $user = [];

        if ($request->has('q')) {
            $search = $request->q;
            $bascula =BasculaConfiguracion::select("cod_bascula", "ipx_bascula")
                    ->where('cod_bascula', 'iLIKE', "%$search%")
                    ->get();
        }

        return response()->json($bascula);
    }

    public function edit($id)
    {
        $editar = Basculas::findOrFail($id);

        return view('basculas.edit', compact('editar'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'cod_bascula' => 'max:10',
            'nom_user'    => 'max:25',
            'nom_menu'    => 'max:10',
            'tipo_peso'   => 'nullable|size:2',
            'automatico'  => 'nullable|size:1' 
        ]);

        Basculas::whereId($id)->update($updateData);

        return redirect('/basculas')->with('success', '¡Báscula actualizada exitosamente!');
    }

    public function destroy($id_basc)
    {
        Basculas::destroy($id_basc);
        return redirect('basculas');
    }
}
