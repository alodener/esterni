<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index');
    }

    public function show($id)
    {
        $serviceProvider = ServiceProvider::with('employees')->find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('employees.show', compact('serviceProvider'));
    }

    public function create($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('employees.create', compact('serviceProvider'));
    }
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'service_provider_id' => 'required|exists:service_providers,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validações da foto
            'system_enable_date' => 'required|date',
            'client_name' => 'required|string',
            'provider_name' => 'required|string',
            'provider_cnpj' => 'required|string|max:18',
            'employee_name' => 'required|string',
            'admission_date' => 'required|date',
            'dismissal_date' => 'nullable|date',
            'job_title' => 'required|string',
            'salary' => 'required|numeric',
            'insalubrity' => 'nullable|boolean',
            'dangerousness' => 'nullable|boolean',
            'work_schedule' => 'required|string',
            'night_shift' => 'nullable|boolean',
            'department' => 'required|string',
            'start_client_allocation' => 'required|date',
            'end_client_allocation' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verifica se há uma foto e faz o upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Faz o upload da foto e armazena o caminho
            $photoPath = $request->file('photo')->store('photos', 'public'); // Armazena na pasta 'photos' no disco 'public'
        }

        // Criar o novo empregado
        $employee = Employee::create([
            'service_provider_id' => $validator['service_provider_id'],
            'photo' => $photoPath, // Salva o caminho da foto
            'system_enable_date' => $validator['system_enable_date'],
            'client_name' => $validator['client_name'],
            'provider_name' => $validator['provider_name'],
            'provider_cnpj' => $validator['provider_cnpj'],
            'employee_name' => $validator['employee_name'],
            'admission_date' => $validator['admission_date'],
            'dismissal_date' => $validator['dismissal_date'],
            'job_title' => $validator['job_title'],
            'salary' => $validator['salary'],
            'insalubrity' => $validator['insalubrity'] ?? false,
            'dangerousness' => $validator['dangerousness'] ?? false,
            'work_schedule' => $validator['work_schedule'],
            'night_shift' => $validator['night_shift'] ?? false,
            'department' => $validator['department'],
            'start_client_allocation' => $validator['start_client_allocation'],
            'end_client_allocation' => $validator['end_client_allocation'],
        ]);

        // Retornar uma resposta ou redirecionar
        return redirect()->route('employees.index')->with('success', 'Funcionario criado com sucesso!');
    }
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
