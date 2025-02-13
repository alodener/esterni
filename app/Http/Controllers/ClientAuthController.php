<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;

class ClientAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('sessions_client.create'); // Criaremos essa view
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'cnpj' => 'required|exists:clients,cnpj',
            'password' => 'required',
        ]);

        if (Auth::guard('client')->attempt(['cnpj' => $request->cnpj, 'password' => $request->password])) {
            session()->regenerate();
            return redirect()->route('dashboard'); // Redireciona para a dashboard do cliente
        }

        return back()->withErrors(['cnpj' => 'CNPJ ou senha incorretos.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.login');
    }
}
