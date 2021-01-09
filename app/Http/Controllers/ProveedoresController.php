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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $tipo_busqueda = $request->get('tipo_busqueda');
        $criterio = $request->get('criterio');

        if ($tipo_busqueda == 'ruc_ci')
        {
            $searches = Proveedores::orderBy('id')->where('ruc_ci', 'like', '%'.$criterio.'%')->paginate(10);
            $count = count($searches);
        }
        elseif ($tipo_busqueda == 'nom_rs')
        {
            $searches = Proveedores::orderBy('id')->where('nombres', 'like', '%'.$criterio.'%')->orWhere('razon_social', 'like', '%'.$criterio.'%')->paginate(10);
            $count = count($searches);
        }

        return view('proveedores.search', compact('searches', 'count', 'criterio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
