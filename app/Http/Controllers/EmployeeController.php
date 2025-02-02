<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

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

    public function create()
    {
        return view('employees.create');
    }
    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
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

        // Verifica se há uma foto e faz o upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Faz o upload da foto e armazena o caminho
            $photoPath = $request->file('photo')->store('photos', 'public'); // Armazena na pasta 'photos' no disco 'public'
        }

        // Criar o novo empregado
        $employee = Employee::create([
            'service_provider_id' => $validated['service_provider_id'],
            'photo' => $photoPath, // Salva o caminho da foto
            'system_enable_date' => $validated['system_enable_date'],
            'client_name' => $validated['client_name'],
            'provider_name' => $validated['provider_name'],
            'provider_cnpj' => $validated['provider_cnpj'],
            'employee_name' => $validated['employee_name'],
            'admission_date' => $validated['admission_date'],
            'dismissal_date' => $validated['dismissal_date'],
            'job_title' => $validated['job_title'],
            'salary' => $validated['salary'],
            'insalubrity' => $validated['insalubrity'] ?? false,
            'dangerousness' => $validated['dangerousness'] ?? false,
            'work_schedule' => $validated['work_schedule'],
            'night_shift' => $validated['night_shift'] ?? false,
            'department' => $validated['department'],
            'start_client_allocation' => $validated['start_client_allocation'],
            'end_client_allocation' => $validated['end_client_allocation'],
        ]);

        // Retornar uma resposta ou redirecionar
        return response()->json([
            'message' => 'Employee created successfully',
            'employee' => $employee
        ], 201);
    }

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
