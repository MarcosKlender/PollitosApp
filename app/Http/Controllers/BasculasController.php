<?php

namespace App\Http\Controllers;

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
        $datos['basculas'] = Basculas::paginate(5);

        return view('basculas.index',$datos);
    }

    public function store(BasculaStoreRequest $request)
    {

        $bascula = Basculas::create($request->all());

        return redirect()->route('basculas.index');
    }

    public function selectSearch(Request $request)
    {

        $user = [];

        if($request->has('q')){
            $search = $request->q;
            $usuario =user::select("username")
                    ->where('username', 'iLIKE', "%$search%")
                    ->get();
        }

        return response()->json($usuario);
    }

     public function update(Request $request, $id)
    {

        $updateData = $request->validate([
            'automatico'=>'nullable|max:1'
        ]);

        Basculas::whereId($id)->update($updateData);
        return redirect('/basculas')->with('success', 'Bascula actualizado exitosamente!');
        

    }

    public function destroy ($id_basc)
    {            
        Basculas::destroy($id_basc);
        return redirect('basculas');
    }


} 