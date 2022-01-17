<?php

namespace App\Http\Controllers;

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
        	]);

        return redirect()->route('basculaconfiguracion.index');
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'tipo_peso' =>'size:2',
            'automatico'=>'size:1'
            
        ]);

        BasculaConfiguracion::whereId($id)->update($updateData);

        return back()->with('success', '¡Báscula actualizada exitosamente!');
    }

     public function destroy($id_basc)
    {

        BasculaConfiguracion::destroy($id_basc);
        return redirect('basculaconfiguracion');
    }


}
