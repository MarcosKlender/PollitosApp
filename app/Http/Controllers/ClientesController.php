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
        $this->middleware(['auth', 'rol']);
    }


    public function index(){

    	$clientes = Clientes::orderBy('id')->paginate(10);
        $count = count(Clientes::all());
        
        return view('clientes.index', compact('clientes', 'count'));
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

}
