<?php

namespace App\Http\Controllers;

use App\Entregas;
use App\Clientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EntregasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $entregas = Entregas::orderBy('id', 'desc')->where('anulado', 0)->paginate(10);
        $count = count($entregas);
        
        return view('entregas.index', compact('entregas', 'count'));
    }

    public function create()
    {
        $clientes = Clientes::select('nombres', 'ruc_ci')->get();

        return view('entregas.create',compact('clientes'));
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'tipo' => 'required|max:15',
            'cliente' => 'required|max:191',
            'ruc_ci' => 'required|digits_between:10,13',
            'placa' => 'required|regex:/^[\pL\pM\pN\s]+$/u|between:6,7',
            'conductor' => 'required|regex:/^[\pL\pM\pN\s]+$/u|max:191',
            'peso_entrega' => 'required|numeric|min:1',
            'usuario' => 'required|max:191',
            'anulado' => 'required|size:1',
        ]);

        $entregas = Entregas::create($storeData);

        // Mantener datos del formulario
        $request->old('tipo');
        $request->old('cliente');
        $request->old('placa');
        $request->old('conductor');
        $request->old('peso_entrega');

        return redirect('/entregas')->with('success', '¡Entrega creada exitosamente!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function selectSearch(Request $request)
    {
        $clientes = [];

        if ($request->has('q')) {
            $search = $request->q;
            $cliente = Clientes::select("ruc_ci", "nombres")
                    ->where('nombres', 'iLIKE', "%$search%")
                    ->get();
        }

        return response()->json($cliente);
    }

    public function entregas_anuladas()
    {
        $entregas = Entregas::orderBy('id', 'desc')->where('anulado', 1)->paginate(10);
        $count = count($entregas);

        if (Auth::user()->rol->key != 'admin') {
            return redirect('/entregas');
        }
        
        return view('entregas.entregas_anuladas', compact('entregas', 'count'));
    }

    public function anular_entrega(Request $request)
    {
        $updateData = $request->validate([
            'anulado' => 'required|size:1',
            'observaciones' => 'max:191',
        ]);
        
        Entregas::whereId($request->id_anular)->update($updateData);

        return back()->with('success', '¡Entrega actualizada exitosamente!');
    }
}
