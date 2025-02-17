<?php

namespace App\Http\Controllers;

use App\Models\PayrollAudit;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollAuditController extends Controller
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
            'web' => ['show', 'create', 'payrollAudit'], // Web tem acesso total pois é admin
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
        return view('indicator_mensal.index', compact('serviceProvider'));
    }

    public function create($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_mensal.create', compact('serviceProvider'));
    }

    public function payrollAudit(Request $request)
    {
        try {
            // Passo 1: Validação dos dados básicos
            $validatedData = $request->validate([
                'month' => 'required|integer|min:1|max:12',
                'year' => 'required|integer|min:2000|max:' . date('Y'),
                'service_provider_id' => 'required|exists:service_providers,id',
            ]);

            // Criar ou buscar o registro existente
            $payrollAudit = PayrollAudit::updateOrCreate([
                'month' => $validatedData['month'],
                'year' => $validatedData['year'],
                'service_provider_id' => $validatedData['service_provider_id'],
            ], []);

            // Array para armazenar os campos validados e consolidar a atualização
            $updateData = [];

            // Mapeamento das seções e validações
            $validationRules = [
                'payroll' => [
                    'payroll_entries_correct' => 'required|string',
                    'payroll_compliance' => 'required|string',
                    'benefits_paid_correctly' => 'required|string',
                    'leave_records_correct' => 'required|string',
                ],
                'work' => [
                    'work_schedules_presented' => 'required|string',
                    'work_records_compliant' => 'required|string',
                    'overtime_compliant' => 'required|string',
                    'rest_periods_complied' => 'required|string',
                ],
                'tax' => [
                    'tax_guides_presented' => 'required|string',
                    'fgts_compliance' => 'required|string',
                    'inss_compliance' => 'required|string',
                    'ir_compliance' => 'required|string',
                ],
                'safety' => [
                    'cat_submitted_on_time' => 'required|string',
                    'cipa_training' => 'required|string',
                    'medical_certificates_presented' => 'required|string',
                    'accident_investigation_presented' => 'required|string',
                ],
            ];

            // Mapeamento das abas correspondentes
            $tabMap = [
                'payroll' => 'folha_pagamento',
                'work' => 'jornada_trabalho',
                'tax' => 'encargo_trabalhista',
                'safety' => 'seguranca_trabalho',
            ];

            foreach ($validationRules as $section => $rules) {
                if ($request->has(array_keys($rules))) {
                    try {
                        $updateData += $request->validate($rules);
                    } catch (\Illuminate\Validation\ValidationException $e) {
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
                $payrollAudit->update(array_filter($updateData));
            }

            return redirect()->back()
                ->withFragment('folha_pagamento') // Aba padrão após sucesso
                ->with('success', 'Indicador mensal cadastrado/atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }
}
