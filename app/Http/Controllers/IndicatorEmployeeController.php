<?php

namespace App\Http\Controllers;

use App\Models\ContractualDocumentation;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndicatorEmployeeController extends Controller
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
            'client' => ['show'], // Clientes só podem acessar index
            'web' => ['show', 'employeeContractualDocs'], // Web tem acesso total pois é admin
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
    public function show($id){
        $serviceProvider = ServiceProvider::find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_employee.index', compact('serviceProvider'));
    }
    public function employeeContractualDocs(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'service_provider_id' => 'required|exists:service_providers,id',

            'admission_protocol' => 'required|string|max:255',
            'employment_contract' => 'required|string|max:255',
            'ethics_code' => 'required|string|max:255',
            'driver_license' => 'nullable|string|max:255',
            'federal_police_clearance' => 'nullable|string|max:255',
            'professional_council_certificate' => 'nullable|string|max:255',
            'electrical_course_certificate' => 'nullable|string|max:255',
            'collective_agreement' => 'required|string|max:255',
        ]);

        // Criar um novo registro
        ContractualDocumentation::create($validatedData);


        return redirect()->back()->with('success', 'Documento cadastrado com sucesso!');
    }
}
