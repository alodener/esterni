<?php

namespace App\Http\Controllers;

use App\Models\PayrollAudit;
use App\Models\ServiceProvider;
use Carbon\Carbon;
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
            'client' => ['show', 'visualizar'], // Clientes só podem acessar index
            'web' => ['visualizar', 'show', 'create', 'edit', 'update', 'payrollAudit', 'destroy'], // Web tem acesso total pois é admin
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
            return redirect()->route('login')->with('error', 'Sua sessão expirou. Faça login novamente.');
        }

        // Verifica se o método chamado está permitido para o usuário autenticado
        if (!in_array($currentAction, $permissions[$this->guard])) {
            abort(403, "O guard '{$this->guard}' não tem permissão para acessar '{$currentAction}'.");
        }
    }

    public function visualizar($id)
    {
        $payrollAudit = PayrollAudit::find($id);
        if (!$payrollAudit) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        $serviceProvider = ServiceProvider::find($payrollAudit->service_provider_id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_mensal.show', compact('payrollAudit', 'serviceProvider'));
    }

    public function show($id)
    {
        $serviceProvider = ServiceProvider::with('payrollAudits')->find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        $payrollAudits = $serviceProvider->payrollAudits()->paginate(1);

        $totalRegistros = $serviceProvider->payrollAudits->count();

        if ($totalRegistros > 0) {
            $totalPayroll = $serviceProvider->payrollAudits->sum('payroll_average_score');
            $totalWorkJourney = $serviceProvider->payrollAudits->sum('work_journey_average_score');
            $totalTaxes = $serviceProvider->payrollAudits->sum('taxes_average_score');
            $totalSST = $serviceProvider->payrollAudits->sum('sst_average_score');

            $media = [
                'Folha de Pagamento' => round($totalPayroll / $totalRegistros, 2),
                'Jornada de Trabalho' => round($totalWorkJourney / $totalRegistros, 2),
                'Encargos trabalhistas' => round($totalTaxes / $totalRegistros, 2),
                'Saúde e Segurança no Trabalho' => round($totalSST / $totalRegistros, 2)
            ];
        } else {
            $media = [
                'Folha de Pagamento' => 0,
                'Jornada de Trabalho' => 0,
                'Encargos trabalhistas' => 0,
                'Saúde e Segurança no Trabalho' => 0
            ];
        }

        // Pega o mês e ano de dois meses atrás
        $currentMonth = Carbon::now()->subMonths(2)->month;
        $currentYear = Carbon::now()->subMonths(2)->year;

        // Pegando a "minha referência" baseada no mês e ano atuais
        $minhaReferencia = $serviceProvider->payrollAudits
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();

        $indicadores = [
            [
                'titulo' => 'Folha de Pagamento',
                'nota' => $minhaReferencia->payroll_average_score ?? 0,
                'minha_referencia' => $minhaReferencia->payroll_average_score ?? 0,
                'media' => $media['Folha de Pagamento']
            ],
            [
                'titulo' => 'Jornada de Trabalho',
                'nota' => $minhaReferencia->work_journey_average_score ?? 0,
                'minha_referencia' => $minhaReferencia->work_journey_average_score ?? 0,
                'media' => $media['Jornada de Trabalho']
            ],
            [
                'titulo' => 'Encargos trabalhistas',
                'nota' => $minhaReferencia->taxes_average_score ?? 0,
                'minha_referencia' => $minhaReferencia->taxes_average_score ?? 0,
                'media' => $media['Encargos trabalhistas']
            ],
            [
                'titulo' => 'Saúde e Segurança no Trabalho',
                'nota' => $minhaReferencia->sst_average_score ?? 0,
                'minha_referencia' => $minhaReferencia->sst_average_score ?? 0,
                'media' => $media['Saúde e Segurança no Trabalho']
            ]
        ];

        return view('indicator_mensal.index', compact('serviceProvider', 'indicadores', 'payrollAudits'));
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

            // Passo 2: Verifica se é atualização ou criação
            if ($request->filled('id')) {
                // Atualização: Busca o registro existente pelo ID
                $payrollAudit = PayrollAudit::findOrFail($request->id);
                $payrollAudit->month = $validatedData['month'];
                $payrollAudit->year = $validatedData['year'];
            } else {
                // Criação: Gera um novo registro
                $payrollAudit = PayrollAudit::firstOrCreate(
                    [
                        'month' => $validatedData['month'],
                        'year' => $validatedData['year'],
                        'service_provider_id' => $validatedData['service_provider_id'],
                    ],
                    []
                );
            }

            // Array para armazenar os campos validados
            $updateData = [];

            // Mapeamento das seções e validações
            $validationRules = [
                'payroll' => [
                    'payroll_entries_correct' => 'required|string',
                    'payroll_compliance' => 'required|string',
                    'benefits_paid_correctly' => 'required|string',
                    'leave_records_correct' => 'required|string',
                    'payroll_notes' => 'nullable|string',
                ],
                'work' => [
                    'work_schedules_presented' => 'required|string',
                    'work_records_compliant' => 'required|string',
                    'overtime_compliant' => 'required|string',
                    'rest_periods_complied' => 'required|string',
                    'work_schedule_notes' => 'nullable|string',
                ],
                'tax' => [
                    'tax_guides_presented' => 'required|string',
                    'fgts_compliance' => 'required|string',
                    'inss_compliance' => 'required|string',
                    'ir_compliance' => 'required|string',
                    'tax_obligations_notes' => 'nullable|string',
                ],
                'safety' => [
                    'cat_submitted_on_time' => 'required|string',
                    'cipa_training' => 'required|string',
                    'medical_certificates_presented' => 'required|string',
                    'accident_investigation_presented' => 'required|string',
                    'health_safety_notes' => 'nullable|string',
                ],
            ];

            // Mapeamento das abas correspondentes
            $tabMap = [
                'payroll' => 'folha_pagamento',
                'work' => 'jornada_trabalho',
                'tax' => 'encargo_trabalhista',
                'safety' => 'seguranca_trabalho',
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
                $payrollAudit->update(array_filter($updateData));
            }

            return redirect()->route('payrollAudit.show', $validatedData['service_provider_id'])->with('success', 'indicador mensal Criado/Alterado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $payrollAudit = PayrollAudit::find($id);
        if (!$payrollAudit) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }

        $serviceProvider = ServiceProvider::find($payrollAudit->service_provider_id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }

        return view('indicator_mensal.edit', compact('payrollAudit', 'serviceProvider'));
    }

    public function update(Request $request, $id)
    {
        $payrollAudit = PayrollAudit::find($id);
        if (!$payrollAudit) {
            // return redirect()->back()->route('payrollAudit.show', $validatedData['service_provider_id'])->with('success', 'indicador mensal excluído com sucesso!');
        }
        // return redirect()->back()->route('payrollAudit.show', $validatedData['service_provider_id'])->with('success', 'indicador mensal excluído com sucesso!');
    }

    public function destroy($id, $serviceProviderId)
    {
        $payrollAudit = PayrollAudit::find($id);
        if (!$payrollAudit) {
            return redirect()->route('payrollAudit.show', $serviceProviderId)->with('error', 'Não foi possivel excluir o indicador mensal');
        }
        $payrollAudit->delete(); // Soft delete

        return redirect()->route('payrollAudit.show', $serviceProviderId)->with('success', 'indicador mensal excluído com sucesso!');
    }
}
