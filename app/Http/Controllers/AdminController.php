<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'rol']);
    }

    public function index()
    {
        $users = User::orderBy('id')->paginate(8);
        $count = count(User::all());
        
        return view('admin.admin', compact('users', 'count'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'rol_id' => 'required|max:1',
            'ci' => 'required|digits:10|unique:users,ci|max:10',
            'name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'password' => 'required|min:6|max:20',
            'active' => 'required|max:1',
        ]);

        $users = User::create($storeData);

        // Mantener datos del formulario
        $request->old('ci');
        $request->old('name');
        $request->old('last_name');
        $request->old('email');

        return redirect('/admin')->with('success', '¡Usuario creado exitosamente!');
    }

    public function show(Request $request)
    {
        $ci = $request->get('ci');
        $searches = User::orderBy('id')->where('ci', 'like', $ci.'%')->paginate(8);
        $count = count($searches);

        return view('admin.search', compact('searches', 'count', 'ci'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'rol_id' => 'required|max:1',
            'ci' => 'required|digits:10|max:10|unique:users,ci,'.$id,
            'name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,'.$id,
            'password' => 'min:6|max:20',
            'active' => 'required|max:1',
        ]);

        if (isset($updateData['password']))
        {
            $updateData['password'] = Hash::make($updateData['password']);
        }
        else
        {
            unset($updateData['password']);
        }
        
        User::whereId($id)->update($updateData);

        return redirect('/admin')->with('success', '¡Usuario actualizado exitosamente!');
    }

    public function destroy($id)
    {
        // $user = User::findOrFail($id);
        // $user->delete();

        // return redirect()->back()->with('success', '¡El usuario ha sido eliminado!');
    }
}
