<?php

namespace App\Http\Controllers;

use App\Models\ContractualDocumentation;
use App\Models\OccupationalHealthSafety;
use App\Models\OccupationalPrograms;
use App\Models\OccupationalTrainings;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            'web' => ['show', 'employeeContractualDocs', 'occupationalProgram', 'occupationalHealthSafety', 'occupationalTraining'], // Web tem acesso total pois é admin
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
    public function show($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_employee.index', compact('serviceProvider'));
    }
    public function employeeContractualDocs(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'service_provider_id' => 'required|exists:service_providers,id',

            'admission_protocol' => 'required|string|max:255',
            'employment_contract' => 'required|string|max:255',
            'ethics_code' => 'required|string|max:255',
            'driver_license' => 'required|string|max:255',
            'federal_police_clearance' => 'required|string|max:255',
            'professional_council_certificate' => 'required|string|max:255',
            'electrical_course_certificate' => 'required|string|max:255',
            'collective_agreement' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $validatedData = $validator->validated();

        // Atualiza ou cria um novo registro baseado no 'service_provider_id'
        ContractualDocumentation::updateOrCreate(
            ['service_provider_id' => $validatedData['service_provider_id']], // Condição de busca
            $validatedData // Dados para atualização/criação
        );

        return redirect()->back()->with('success', 'Documento cadastrado/atualizado com sucesso!');
    }

    public function occupationalProgram(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_provider_id' => 'required|exists:service_providers,id',
            'ltcat' => 'required|string|max:255',
            'pgr' => 'required|string|max:255',
            'pcmso' => 'required|string|max:255',
            'insalubrity_report' => 'required|string|max:255',
            'danger_report' => 'required|string|max:255',
            'aet' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        OccupationalPrograms::updateOrCreate(
            ['service_provider_id' => $validatedData['service_provider_id']], // Condição de busca
            $validatedData // Dados para atualizar ou criar
        );

        return redirect()->back()->with('success', 'Programa ocupacional cadastrado/atualizado com sucesso!');
    }

    public function occupationalHealthSafety(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'service_provider_id' => 'required|exists:service_providers,id',
            'aso' => 'required|string|max:255',
            'complementary_exams' => 'required|string|max:255',
            'work_order' => 'required|string|max:255',
            'epi_uniform_record' => 'required|string|max:255',
            'esocial_events_submission' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Atualiza ou cria um novo registro baseado no 'service_provider_id'
        OccupationalHealthSafety::updateOrCreate(
            ['service_provider_id' => $validatedData['service_provider_id']], // Condição de busca
            $validatedData // Dados para atualização/criação
        );

        return redirect()->back()->with('success', 'Registro cadastrado/atualizado com sucesso!');
    }

    public function occupationalTraining(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'service_provider_id' => 'required|exists:service_providers,id',

            'nr_01_general_safety' => 'required|string|max:255',
            'nr_04_epi' => 'required|string|max:255',
            'nr_18_construction' => 'required|string|max:255',
            'nr_35_work_at_height' => 'required|string|max:255',
            'nr_10_electricity' => 'required|string|max:255',
            'nr_11_transport_handling' => 'required|string|max:255',
            'nr_14_furnaces' => 'required|string|max:255',
            'nr_17_ergonomics' => 'required|string|max:255',
            'nr_19_explosives' => 'required|string|max:255',
        ]);

        // Atualiza ou cria um novo registro baseado no 'service_provider_id'
        OccupationalTrainings::updateOrCreate(
            ['service_provider_id' => $validatedData['service_provider_id']], // Condição de busca
            $validatedData // Dados para atualização/criação
        );

        return redirect()->back()->with('success', 'Treinamento ocupacional cadastrado/atualizado com sucesso!');
    }
}
