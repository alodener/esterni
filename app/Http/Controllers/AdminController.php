<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::paginate(1);
        return view('admin.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'Admin não encontrado');
        }
        return view('admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'Admin não encontrado');
        }
        return view('admin.edit', compact('user'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name . ' ' . $request->sobrenome,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.index')->with('status', 'Admin criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'max:255',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->name . ' ' . $request->sobrenome;
        $user->email = $request->email;

        // Atualiza a senha apenas se for informada
        if ($request->has('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('admin.index')->with('success', 'Admin atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'Admin não encontrado');
        }

        $user->delete();
        return redirect()->route('admin.index')->with('success', 'Admin removido com sucesso!');
    }
}
