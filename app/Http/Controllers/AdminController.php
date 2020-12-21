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
        
        return view('admin', compact('users', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'rol_id' => 'required|max:1',
            'name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'password' => 'required|min:6|max:20',
            'active' => 'required|max:1',
        ]);

        $users = User::create($storeData);

        // Mantener datos del formulario
        $request->old('name');
        $request->old('last_name');
        $request->old('email');

        return redirect('/admin')->with('success', '¡Usuario creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('edit', compact('user'));
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
        $updateData = $request->validate([
            'rol_id' => 'required|max:1',
            'name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,'.$id,
            'password' => '',
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

        if ($updateData['email'] == User::whereId($id)->value('email'))
        {
            unset($updateData['email']);
        }
        
        User::whereId($id)->update($updateData);

        return redirect('/admin')->with('success', '¡Usuario actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user = User::findOrFail($id);
        // $user->delete();

        // return redirect()->back()->with('success', '¡El usuario ha sido eliminado!');
    }
}
