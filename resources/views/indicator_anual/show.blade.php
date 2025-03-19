<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Indicador Anual - Visualizar"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-0">
            <div class="mt-4">
                <div class="h-400 mb-4">

                    <div class="row container">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-fill mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#folha_13">Folha 13º</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#ferias">Férias</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#saude_seguranca_trabalho">Saúde e
                                    Segurança no Trabalho </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#ccc_act_fgts">CCT/ACT e FGTS</a>
                            </li>
                        </ul>

                        @php
                            $tabs = [
                                'folha_13' => 'Folha 13º',
                                'ferias' => 'Férias',
                                'saude_seguranca_trabalho' => 'Saúde e Segurança no Trabalho',
                                'ccc_act_fgts' => 'CCT/ACT e FGTS'
                            ];
                            $activeTab = request('tab', 'folha_pagamento'); // Pega a aba ativa da query string
                        @endphp

                        <div class="header-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 id="tabTitle">Folha 13º</h3>
                                <div class="bg-white text-center p-2 rounded">
                                    <p class="mb-0 text-dark" id="nota_geral"><b>NOTA GERAL</b></p>
                                    <h2 class="text-secondary" id="nota_geral_valor">{{ $auditCompliance->getPayrollThirteenthAverageScoreAttribute() }}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td><strong>Tipo</strong></td>
                                        <td>Anual</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ano analisado</strong></td>
                                        <td>{{ $auditCompliance->year }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tomador</strong></td>
                                        <td>{{ $serviceProvider->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Prestador</strong></td>
                                        <td>{{ $serviceProvider->social_purpose }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>CNPJ do Prestador</strong></td>
                                        <td>{{ $serviceProvider->provider_cnpj }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>



                        <!-- Form Unificado -->
                        <form method="POST" action="{{ route('auditCompliance.auditCompliance') }}"
                            enctype="multipart/form-data" class="mt-4 p-0">
                            @csrf

                            <h1 class="mb-4" id="tabTitle2">Folha 13º</h1>
                            <div class="tab-content card">
                                <!-- SECTION: Folha 13º -->
                                <div id="folha_13" class="container tab-pane active">
                                    <div class="row">
                                        <table class="w-full text-left border-collapse">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="p-3 text-gray-700">CATEGORIA</th>
                                                    <th class="p-3 text-gray-700 text-center">RESULTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $categories = [
                                                        'Lançamentos e pagamentos corretos' => $auditCompliance->payroll_thirteenth_launches,
                                                        'Conformidade nos lançamentos e pagamento do FGTS' => $auditCompliance->payroll_thirteenth_fgts,
                                                        'Conformidade nos lançamentos e pagamento do INSS' => $auditCompliance->payroll_thirteenth_inss,
                                                        'Conformidade nos lançamentos e pagamento do IR' => $auditCompliance->payroll_thirteenth_ir,
                                                    ];
                                                    $statusColors = [
                                                        'Conforme' => 'text-green-500',
                                                        'Não Conforme' => 'text-red-500',
                                                        'Conforme Parcialmente' => 'text-yellow-500',
                                                        'Não se aplica' => 'text-gray-500'
                                                    ];
                                                @endphp

                                                @foreach ($categories as $category => $status)
                                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                                        <td class="p-3 font-medium">{{ $category }}</td>
                                                        <td class="p-3 text-center">
                                                            <span class="text-lg {{ $statusColors[$status] ?? 'text-gray-500' }}">
                                                                @if ($status == 'Conforme' || $status == 'Não se aplica')
                                                                    🟢
                                                                @elseif ($status == 'Não Conforme')
                                                                    🔴
                                                                @else
                                                                    🟡
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- SECTION: Férias -->
                                <div id="ferias" class="container tab-pane fade">
                                    <div class="row">
                                        <table class="w-full text-left border-collapse">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="p-3 text-gray-700">CATEGORIA</th>
                                                    <th class="p-3 text-gray-700 text-center">RESULTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $categories = [
                                                        'As férias foram concedidas dentro do prazo legal?' => $auditCompliance->vacation_granted_on_time,
                                                        'As férias foram pagas dentro do prazo legal?' => $auditCompliance->vacation_paid_on_time,
                                                        'Existe planejamento de férias?' => $auditCompliance->vacation_planning,
                                                        'A documentação de férias foi elaborada e assinada?' => $auditCompliance->vacation_documentation
                                                    ];
                                                    $statusColors = [
                                                        'Conforme' => 'text-green-500',
                                                        'Não Conforme' => 'text-red-500',
                                                        'Conforme Parcialmente' => 'text-yellow-500',
                                                        'Não se aplica' => 'text-gray-500'
                                                    ];
                                                @endphp

                                                @foreach ($categories as $category => $status)
                                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                                        <td class="p-3 font-medium">{{ $category }}</td>
                                                        <td class="p-3 text-center">
                                                            <span class="text-lg {{ $statusColors[$status] ?? 'text-gray-500' }}">
                                                                @if ($status == 'Conforme' || $status == 'Não se aplica')
                                                                    🟢
                                                                @elseif ($status == 'Não Conforme')
                                                                    🔴
                                                                @else
                                                                    🟡
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!-- SECTION: Saúde e Segurança no Trabalho -->
                                <div id="saude_seguranca_trabalho" class="container tab-pane fade">
                                    <div class="row">
                                        <table class="w-full text-left border-collapse">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="p-3 text-gray-700">CATEGORIA</th>
                                                    <th class="p-3 text-gray-700 text-center">RESULTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $categories = [
                                                        'Exames periódicos realizados' => $auditCompliance->occupational_exams,
                                                        'Programas Ocupacionais vigentes' => $auditCompliance->occupational_programs,
                                                        'Treinamentos ocupacionais realizados' => $auditCompliance->occupational_trainings,
                                                        'Eventos do eSocial enviados em conformidade' => $auditCompliance->esocial_events
                                                    ];
                                                    $statusColors = [
                                                        'Conforme' => 'text-green-500',
                                                        'Não Conforme' => 'text-red-500',
                                                        'Conforme Parcialmente' => 'text-yellow-500',
                                                        'Não se aplica' => 'text-gray-500'
                                                    ];
                                                @endphp

                                                @foreach ($categories as $category => $status)
                                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                                        <td class="p-3 font-medium">{{ $category }}</td>
                                                        <td class="p-3 text-center">
                                                            <span class="text-lg {{ $statusColors[$status] ?? 'text-gray-500' }}">
                                                                @if ($status == 'Conforme' || $status == 'Não se aplica')
                                                                    🟢
                                                                @elseif ($status == 'Não Conforme')
                                                                    🔴
                                                                @else
                                                                    🟡
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!-- SECTION: CCT/ACT e FGTS -->
                                <div id="ccc_act_fgts" class="container tab-pane fade">
                                    <div class="row">
                                        <table class="w-full text-left border-collapse">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="p-3 text-gray-700">CATEGORIA</th>
                                                    <th class="p-3 text-gray-700 text-center">RESULTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $categories = [
                                                        'Salário pago com base na CCT/ACT' => $auditCompliance->salary_cct_act,
                                                        'Jornadas de trabalho especiais realizadas conforme CCT/ACT' => $auditCompliance->special_work_shifts_cct_act,
                                                        'Pagamento dos benefícios e adicionais conforme CCT/ACT' => $auditCompliance->benefits_cct_act,
                                                        'Saldo de FGTS depositado corretamente' => $auditCompliance->fgts_balance_deposited
                                                    ];
                                                    $statusColors = [
                                                        'Conforme' => 'text-green-500',
                                                        'Não Conforme' => 'text-red-500',
                                                        'Conforme Parcialmente' => 'text-yellow-500',
                                                        'Não se aplica' => 'text-gray-500'
                                                    ];
                                                @endphp

                                                @foreach ($categories as $category => $status)
                                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                                        <td class="p-3 font-medium">{{ $category }}</td>
                                                        <td class="p-3 text-center">
                                                            <span class="text-lg {{ $statusColors[$status] ?? 'text-gray-500' }}">
                                                                @if ($status == 'Conforme' || $status == 'Não se aplica')
                                                                    🟢
                                                                @elseif ($status == 'Não Conforme')
                                                                    🔴
                                                                @else
                                                                    🟡
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Botões de Ação -->
                                <!-- Botões de Ação -->
                                @can('isAdmin')
                                    <div class="mt-3 d-flex justify-content-end">
                                        <a href="{{ route('auditCompliance.show', $serviceProvider->id) }}"
                                            class="btn btn-light me-2">Voltar</a>
                                    </div>
                                @endcan

                                @can('isClient')
                                    <div class="mt-3 d-flex justify-content-end">
                                        <a href="{{ route('auditCompliance.show', $serviceProvider->id) }}"
                                            class="btn btn-primary me-2">Voltar</a>
                                    </div>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <style>
        .header-card {
            background: url("{{ asset('assets/img/esterni/header_gradient.png') }}") no-repeat center center;
            background-size: cover;
            border-radius: 10px;
            padding: 20px;
            color: white;
            position: relative;

            h3 {
                margin-left: 40px;
                color: white;
            }

            div {
                margin-right: 25px;
            }

            div {
                #nota_geral {
                    width: 100px;
                    font-size: 12px;
                }
            }

            div {
                #nota_geral {
                    width: 100px;
                    font-size: 12px;
                }
            }
        }
    </style>
    @push('js')
        <!-- JavaScript para Atualizar o Título -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const tabs = {
                    "folha_13": "Folha 13º",
                    "ferias": "Férias",
                    "saude_seguranca_trabalho": "Saúde e Segurança no Trabalho",
                    "ccc_act_fgts": "CCT/ACT e FGTS"
                };

                const scores = {
                    folha_13: {{ $auditCompliance->getPayrollThirteenthAverageScoreAttribute() }},
                    ferias: {{ $auditCompliance->getVacationAverageScoreAttribute() }},
                    saude_seguranca_trabalho: {{ $auditCompliance->getOccupationalHealthAverageScoreAttribute() }},
                    ccc_act_fgts: {{ $auditCompliance->getCctActFgtsAverageScoreAttribute() }}
                };

                document.querySelectorAll(".nav-link").forEach(tab => {
                    tab.addEventListener("click", function () {
                        const selectedTab = this.getAttribute("href").replace("#", "");
                        document.getElementById("tabTitle").textContent = tabs[selectedTab];
                        document.getElementById("tabTitle2").textContent = tabs[selectedTab];
                        document.getElementById("nota_geral_valor").textContent = scores[selectedTab] || "N/A"; // Atualiza a nota
                    });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                        // Obtém a hash da URL
                        let hash = window.location.hash;

                        if (hash) {
                            let tab = document.querySelector(`a[href="${hash}"]`);
                            if (tab) {
                                new bootstrap.Tab(tab).show();
                            }
                        }

                        // Atualiza a URL ao trocar de aba (opcional)
                        document.querySelectorAll('.nav-link').forEach(tab => {
                            tab.addEventListener('click', function() {
                                history.pushState(null, null, this.getAttribute('href;
                                });
                            });
                        });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Força a abertura do modal ao carregar a página
                var modal = new bootstrap.Modal(document.getElementById('monthYearModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                modal.show();

                // Recuperando valores antigos do Laravel
                let oldYear = "{{ $auditCompliance->year }}";
                let yearSelect = document.getElementById("year");
                let currentYear = new Date().getFullYear();

                for (let i = currentYear + 1; i >= currentYear - 10; i--) {
                    let option = document.createElement("option");
                    option.value = i;
                    option.textContent = i;

                    // Aplica o valor antigo do Laravel se existir
                    if (oldYear == i) {
                        option.selected = true;
                    }

                    yearSelect.appendChild(option);
                }

                // Desabilitar botão até que mês e ano sejam selecionados
                let confirmButton = document.getElementById("confirmSelection");

                function validateSelection() {
                    confirmButton.disabled = !(yearSelect.value);
                }

                yearSelect.addEventListener("change", validateSelection);

                // Habilita o botão caso os valores antigos já estejam preenchidos
                validateSelection();

                // Fechar modal apenas quando o usuário confirmar a seleção
                confirmButton.addEventListener("click", function() {
                    modal.hide();
                });
            });
        </script>
    @endpush
</x-layout>
