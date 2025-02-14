<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    protected $guard;
    protected $user;
    public function __construct()
    {
        // Aplica o middleware primeiro para garantir autenticação
        $this->middleware('auth:client,web');

        // Adia a validação de permissões para depois que o middleware rodar
        $this->middleware(function ($request, $next) {
            $this->checkPermissions($request);
            return $next($request);
        });
    }

    /**
     * Verifica se o usuário autenticado tem permissão para acessar o método.
     */
    private function checkPermissions($request)
    {
        // Permissões por nome de método
        $permissions = [
            'client' => ['index', 'show', 'edit'], // Clientes só podem acessar index
            'web' => ['index', 'store', 'update', 'destroy'], // Web tem acesso total pois é admin
        ];

        // Descobre o nome do método sendo chamado
        $currentAction = $request->route()->getActionMethod();

        // Identifica qual guard está autenticado
        foreach ($permissions as $guard => $allowedMethods) {
            if (Auth::guard($guard)->check()) {
                $this->guard = $guard;
                $this->user = Auth::guard($guard)->user();
                break;
            }
        }

        // Bloqueia acesso caso nenhum guard esteja autenticado
        if (!$this->guard) {
            abort(403, 'Acesso não autorizado.');
        }

        // Verifica se o método chamado está permitido para o usuário autenticado
        if (!in_array($currentAction, $permissions[$this->guard])) {
            abort(403, "O guard '{$this->guard}' não tem permissão para acessar '{$currentAction}'.");
        }
    }
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
        $data = $validator->validated();
        // Verifica se há uma foto e faz o upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Faz o upload da foto e armazena o caminho
            $photoPath = $request->file('photo')->store('photos', 'public'); // Armazena na pasta 'photos' no disco 'public'
        }

        // Criar o novo empregado
        $employee = Employee::create([
            'service_provider_id' => $data['service_provider_id'],
            'photo' => $photoPath, // Salva o caminho da foto
            'system_enable_date' => $data['system_enable_date'],
            'client_name' => $data['client_name'],
            'provider_name' => $data['provider_name'],
            'provider_cnpj' => $data['provider_cnpj'],
            'employee_name' => $data['employee_name'],
            'admission_date' => $data['admission_date'],
            'dismissal_date' => $data['dismissal_date'],
            'job_title' => $data['job_title'],
            'salary' => $data['salary'],
            'insalubrity' => $data['insalubrity'] ?? false,
            'dangerousness' => $data['dangerousness'] ?? false,
            'work_schedule' => $data['work_schedule'],
            'night_shift' => $data['night_shift'] ?? false,
            'department' => $data['department'],
            'start_client_allocation' => $data['start_client_allocation'],
            'end_client_allocation' => $data['end_client_allocation'],
        ]);

        // Retornar uma resposta ou redirecionar
        return redirect()->route('employees.show', $data['service_provider_id'])->with('success', 'Funcionario criado com sucesso!');
    }
    public function edit(Employee $employee, $serviceProvider)
    {
        $serviceProvider = ServiceProvider::with('employees')->find($serviceProvider);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $serviceProvider)->with('error', 'Prestador não encontrado');
        }
        return view('employees.edit', compact('serviceProvider', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
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

        $data = $validator->validated();

        // Verifica se há uma nova foto e faz o upload
        if ($request->hasFile('photo')) {
            // Remove a foto antiga, se houver
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            // Faz o upload da nova foto
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // Atualiza os dados do empregado
        $employee->update([
            'service_provider_id' => $data['service_provider_id'],
            'photo' => $data['photo'] ?? $employee->photo,
            'system_enable_date' => $data['system_enable_date'],
            'client_name' => $data['client_name'],
            'provider_name' => $data['provider_name'],
            'provider_cnpj' => $data['provider_cnpj'],
            'employee_name' => $data['employee_name'],
            'admission_date' => $data['admission_date'],
            'dismissal_date' => $data['dismissal_date'],
            'job_title' => $data['job_title'],
            'salary' => $data['salary'],
            'insalubrity' => $data['insalubrity'] ?? false,
            'dangerousness' => $data['dangerousness'] ?? false,
            'work_schedule' => $data['work_schedule'],
            'night_shift' => $data['night_shift'] ?? false,
            'department' => $data['department'],
            'start_client_allocation' => $data['start_client_allocation'],
            'end_client_allocation' => $data['end_client_allocation'],
        ]);

        return redirect()->route('employees.show', $data['service_provider_id'])->with('success', 'Funcionário atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $serviceProviderId)
    {
        $employee = Employee::find($id);
        if(!$employee){
            return redirect()->route('employees.show', $serviceProviderId)->with('error', 'Não foi possivel excluir o funcionário');
        }
        $employee->delete(); // Soft delete

        return redirect()->route('employees.show', $serviceProviderId)->with('success', 'Funcionário excluído com sucesso!');
    }
}
