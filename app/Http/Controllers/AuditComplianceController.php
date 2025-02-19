<?php

namespace App\Http\Controllers;

use App\Models\AuditCompliance;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditComplianceController extends Controller
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
            'web' => ['visualizar', 'show', 'create', 'edit', 'update', 'auditCompliance', 'destroy'], // Web tem acesso total pois é admin
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

    public function visualizar($id)
    {
        $auditCompliance = AuditCompliance::find($id);
        if (!$auditCompliance) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        $serviceProvider = ServiceProvider::find($auditCompliance->service_provider_id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_anual.show', compact('auditCompliance', 'serviceProvider'));
    }

    public function show($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_anual.index', compact('serviceProvider'));
    }

    public function create($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_anual.create', compact('serviceProvider'));
    }

    public function auditCompliance(Request $request)
    {
        try {
            // Passo 1: Validação dos dados básicos
            $validatedData = $request->validate([
                'year' => 'required|integer|min:2000|max:' . date('Y'),
                'service_provider_id' => 'required|exists:service_providers,id',
            ]);

            // Passo 2: Verifica se é atualização ou criação
            if ($request->filled('id')) {
                // Atualização: Busca o registro existente pelo ID
                $auditCompliance = AuditCompliance::findOrFail($request->id);
                $auditCompliance->year = $validatedData['year'];
            } else {
                // Criação: Gera um novo registro
                $auditCompliance = AuditCompliance::updateOrCreate([
                    'year' => $validatedData['year'],
                    'service_provider_id' => $validatedData['service_provider_id'],
                ], []);
            }

            // Array para armazenar os campos validados
            $updateData = [];

            // Mapeamento das seções e validações
            $validationRules = [
                'payroll' => [
                    'payroll_thirteenth_launches' => 'required|string',
                    'payroll_thirteenth_fgts' => 'required|string',
                    'payroll_thirteenth_inss' => 'required|string',
                    'payroll_thirteenth_ir' => 'required|string',
                ],
                'work' => [
                    'vacation_granted_on_time' => 'required|string',
                    'vacation_paid_on_time' => 'required|string',
                    'vacation_planning' => 'required|string',
                    'vacation_documentation' => 'required|string',
                ],
                'tax' => [
                    'occupational_exams' => 'required|string',
                    'occupational_programs' => 'required|string',
                    'occupational_trainings' => 'required|string',
                    'esocial_events' => 'required|string',
                ],
                'safety' => [
                    'salary_cct_act' => 'required|string',
                    'special_work_shifts_cct_act' => 'required|string',
                    'benefits_cct_act' => 'required|string',
                    'fgts_balance_deposited' => 'required|string',
                ],
            ];

            // Mapeamento das abas correspondentes
            $tabMap = [
                'payroll' => 'folha_13',
                'work' => 'ferias',
                'tax' => 'saude_seguranca_trabalho',
                'safety' => 'ccc_act_fgts',
            ];

            // Armazena os dados que passaram para re-popular na sessão
            $validDataForSession = [];

            foreach ($validationRules as $section => $rules) {
                if ($request->has(array_keys($rules))) {
                    try {
                        $validatedSection = $request->validate($rules);
                        $updateData += $validatedSection;
                        $validDataForSession += $validatedSection;
                    } catch (\Illuminate\Validation\ValidationException $e) {
                        session()->flash('valid_data', $validDataForSession); // 🔹 Guarda os valores válidos antes do erro

                        return redirect()->back()
                            ->withInput()
                            ->withFragment($tabMap[$section]) // Define a aba correta
                            ->withErrors($e->validator)
                            ->with('error', 'Erro ao salvar os dados da seção: ' . str_replace('_', ' ', $tabMap[$section]));
                    }
                }
            }

            // Atualiza os campos preenchidos no banco
            if (!empty($updateData)) {
                $auditCompliance->update(array_filter($updateData));
            }

            return redirect()->route('auditCompliance.show', $validatedData['service_provider_id'])->with('success', 'indicador anual Criado/Alterado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $auditCompliance = AuditCompliance::find($id);
        if (!$auditCompliance) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }

        $serviceProvider = ServiceProvider::find($auditCompliance->service_provider_id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }

        return view('indicator_anual.edit', compact('auditCompliance', 'serviceProvider'));
    }

    public function update(Request $request, $id)
    {
        $auditCompliance = AuditCompliance::find($id);
        if (!$auditCompliance) {
            // return redirect()->back()->route('auditCompliance.show', $validatedData['service_provider_id'])->with('success', 'indicador mensal excluído com sucesso!');
        }
        // return redirect()->back()->route('auditCompliance.show', $validatedData['service_provider_id'])->with('success', 'indicador mensal excluído com sucesso!');
    }

    public function destroy($id, $serviceProviderId)
    {
        $auditCompliance = AuditCompliance::find($id);
        if (!$auditCompliance) {
            return redirect()->route('auditCompliance.show', $serviceProviderId)->with('error', 'Não foi possivel excluir o indicador anual');
        }
        $auditCompliance->delete(); // Soft delete

        return redirect()->route('auditCompliance.show', $serviceProviderId)->with('success', 'indicador anual excluído com sucesso!');
    }
}
