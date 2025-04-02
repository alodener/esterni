<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Indicador Mensal - Visualizar"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">


            <div class="mt-4">
                <div class="h-400 mb-4">
                    <div class="row container">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-fill mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#folha_pagamento">Folha de
                                    Pagamento</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#jornada_trabalho">Jornada de
                                    Trabalho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#encargo_trabalhista">Encargos
                                    Trabalhistas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#saude_seguranca_trabalho">Saúde e
                                    Segurança no Trabalho</a>
                            </li>
                        </ul>

                        @php
                            $tabs = [
                                'folha_pagamento' => 'Folha de Pagamento',
                                'jornada_trabalho' => 'Jornada de Trabalho',
                                'encargo_trabalhista' => 'Encargos Trabalhistas',
                                'saude_seguranca_trabalho' => 'Saúde e Segurança no Trabalho'
                            ];
                            $activeTab = request('tab', 'folha_pagamento'); // Pega a aba ativa da query string
                        @endphp

                        <div class="header-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 id="tabTitle">Folha de Pagamento</h3>
                                <div class="bg-white text-center p-2 rounded">
                                    <p class="mb-0 text-dark" id="nota_geral"><b>NOTA GERAL</b></p>
                                    <h2 class="text-secondary" id="nota_geral_valor">{{ $payrollAudit->getPayrollAverageScoreAttribute() }}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td><strong>Tipo</strong></td>
                                        <td>Mensal</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ano analisado</strong></td>
                                        <td>{{ $payrollAudit->year }}</td>
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
                        <form method="POST" action="{{ route('payrollAudit.payrollAudit') }}"
                            enctype="multipart/form-data" class="mt-4 p-0">
                            @csrf

                            <h1 class="mb-4" id="tabTitle2">Folha de Pagamento</h1>

                            <div class="tab-content card">

                                <!-- NOTE: Folha de Pagamento -->
                                <div id="folha_pagamento" class="container tab-pane active card-body">
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
                                                        'Lançamentos dos Colaboradores e Eventos' => $payrollAudit->payroll_entries_correct,
                                                        'Pagamento: Folha/Férias/Rescisões' => $payrollAudit->payroll_compliance,
                                                        'Pagamento dos Benefícios' => $payrollAudit->benefits_paid_correctly,
                                                        'Afastamentos' => $payrollAudit->leave_records_correct
                                                    ];
                                                    $statusColors = [
                                                        'Conforme' => 'text-green-500',
                                                        'Não se aplica' => 'text-green-500',
                                                        'Não Conforme' => 'text-red-500',
                                                        'Conforme Parcialmente' => 'text-yellow-500'
                                                    ];
                                                @endphp

                                                @foreach ($categories as $category => $status)
                                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                                        <td class="p-3 font-medium">{{ $category }}</td>
                                                        <td class="p-3 d-flex justify-content-center">
                                                            <span class="text-lg {{ $statusColors[$status] }}">
                                                                @if ($status == 'Conforme' || $status == 'Não se Aplica')
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
                                    teste
                                </div>

                                <!-- NOTE: Jornada de Trabalho -->
                                <div id="jornada_trabalho" class="container tab-pane fade">
                                    {{-- <h1>Jornada de Trabalho</h1> --}}
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
                                                        'Espelhos de Ponto Apresentados' => $payrollAudit->work_schedules_presented,
                                                        'Registros realizados em conformidade' => $payrollAudit->work_records_compliant,
                                                        'Horas extras realizadas em conformidade com a CLT' => $payrollAudit->overtime_compliant,
                                                        'Cumprimento intrajornada e interjornada' => $payrollAudit->rest_periods_complied
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

                                <!-- NOTE: Encargos Trabalhistas -->
                                <div id="encargo_trabalhista" class="container tab-pane fade">
                                    {{-- <h1>Encargos Trabalhistas</h1> --}}
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
                                                        'Guias e detalhamentos/relatórios apresentados (FGTS/INSS/IR)' => $payrollAudit->tax_guides_presented,
                                                        'Conformidade nos lançamentos e pagamento do FGTS' => $payrollAudit->fgts_compliance,
                                                        'Conformidade nos lançamentos e pagamento do INSS' => $payrollAudit->inss_compliance,
                                                        'Conformidade nos lançamentos e pagamento do IR' => $payrollAudit->ir_compliance
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

                                <!-- NOTE: Saúde e Segurança no Trabalho -->
                                <div id="saude_seguranca_trabalho" class="container tab-pane fade">
                                    {{-- <h1>Saúde e Segurança no Trabalho</h1> --}}
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
                                                        'CAT emitida e enviada ao eSocial dentro do prazo legal' => $payrollAudit->cat_submitted_on_time,
                                                        'CIPA/treinamentos' => $payrollAudit->cipa_training,
                                                        'Atestados apresentados (doença relacionada às atividades laborais)' => $payrollAudit->medical_certificates_presented,
                                                        'Investigação de Acidente - apresentado' => $payrollAudit->accident_investigation_presented
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
                            </div>

                            <!-- Botões de Ação -->
                            @can('isAdmin')
                                <div class="mt-3 d-flex justify-content-end">
                                    <a href="{{ route('payrollAudit.show', $serviceProvider->id) }}" class="btn btn-light me-2">Voltar</a>
                                </div>
                            @endcan

                            @can('isClient')
                                <a href="{{ route('payrollAudit.show', $serviceProvider->id) }}"
                                    class="btn btn-primary">Voltar</a>
                            @endcan
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
                    "folha_pagamento": "Folha de Pagamento",
                    "jornada_trabalho": "Jornada de Trabalho",
                    "encargo_trabalhista": "Encargos Trabalhistas",
                    "saude_seguranca_trabalho": "Saúde e Segurança no Trabalho"
                };

                const scores = {
                    folha_pagamento: {{ $payrollAudit->getPayrollAverageScoreAttribute() }},
                    jornada_trabalho: {{ $payrollAudit->getWorkJourneyAverageScoreAttribute() }},
                    encargo_trabalhista: {{ $payrollAudit->getTaxesAverageScoreAttribute() }},
                    saude_seguranca_trabalho: {{ $payrollAudit->getSstAverageScoreAttribute() }}
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
                let oldMonth = "{{ $payrollAudit->month }}";
                let oldYear = "{{ $payrollAudit->year }}";

                // Preenchendo o campo de ano dinamicamente (últimos 10 anos até o próximo ano)
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

                // Selecionando o mês salvo anteriormente
                let monthSelect = document.getElementById("month");
                if (oldMonth) {
                    monthSelect.value = oldMonth;
                }

                // Desabilitar botão até que mês e ano sejam selecionados
                let confirmButton = document.getElementById("confirmSelection");

                function validateSelection() {
                    confirmButton.disabled = !(monthSelect.value && yearSelect.value);
                }

                monthSelect.addEventListener("change", validateSelection);
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
