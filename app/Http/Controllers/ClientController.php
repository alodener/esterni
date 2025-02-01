<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('client.index', compact('clients'));
    }

    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return redirect()->route('client.index')->with('error', 'Cliente não encontrado');
        }
        return view('client.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return redirect()->route('client.index')->with('error', 'Cliente não encontrado');
        }
        return view('client.edit', compact('client'));
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:255|unique:clients',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip_code' => 'required|string|max:9',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
// dd('teste');
        $client = Client::create([
            'name' => $request->name,
            'cnpj' => $request->cnpj,
            'password' => Hash::make($request->password),
        ]);

        $address = new Address([
            'street' => $request->street,
            'number' => $request->number,
            'complement' => $request->complement,
            'district' => $request->district,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
        ]);

        $client->addresses()->save($address);

        return redirect()->route('client.index')->with('status', 'Cliente criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $client = Client::with('addresses')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:255', // Validação condicional
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip_code' => 'required|string|max:9',
            'country' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Senha opcional
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client->name = $request->name;
        $client->cnpj = $request->cnpj;
        $client->status = $request->input('status');
        $client->save();

        // Atualiza o endereço (se existir)
        if ($client->addresses->first()) {
            $address = $client->addresses->first();
            $address->street = $request->street;
            $address->number = $request->number;
            $address->complement = $request->complement;
            $address->district = $request->district;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->zip_code = $request->zip_code;
            $address->country = $request->country;
            $address->save();
        } else {
            // Cria um novo endereço se não existir
             $address = new Address([
                'street' => $request->street,
                'number' => $request->number,
                'complement' => $request->complement,
                'district' => $request->district,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
            ]);
            $client->addresses()->save($address);
        }

        // Atualiza a senha (se foi informada)
        if ($request->password) {
            $client->password = Hash::make($request->password);
            $client->save();
        }

        return redirect()->route('client.index')->with('status', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return redirect()->route('client.index')->with('error', 'Cliente não encontrado');
        }

        $client->delete();
        return redirect()->route('client.index')->with('success', 'Cliente removido com sucesso!');
    }
}
