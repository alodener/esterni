<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Indicador Mensal"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-0">
            <div class="card card-body mx-md-4 mt-4">
                <div class="card card-plain h-100 mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center">
                                <h6 class="mb-0">Indicador Mensal</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-0 mb-2">
                        @php
                            // Contar quantos registros existem
                            $totalRegistros = $serviceProvider->payrollAudits->count();

                            // Evitar divisão por zero
                            if ($totalRegistros > 0) {
                                // Calcular a soma dos valores de cada categoria
                                $totalPayroll = $serviceProvider->payrollAudits->sum('payroll_average_score');
                                $totalWorkJourney = $serviceProvider->payrollAudits->sum('work_journey_average_score');
                                $totalTaxes = $serviceProvider->payrollAudits->sum('taxes_average_score');
                                $totalSST = $serviceProvider->payrollAudits->sum('sst_average_score');

                                // Calcular a média dividindo pelo total de registros
                                $habilitacoes = [
                                    [
                                        'titulo' => 'Folha de pagamento',
                                        'valor' => round($totalPayroll / $totalRegistros, 2),
                                        'icone' => 'receipt_long',
                                    ],
                                    [
                                        'titulo' => 'Jornada de trabalho',
                                        'valor' => round($totalWorkJourney / $totalRegistros, 2),
                                        'icone' => 'schedule',
                                    ],
                                    [
                                        'titulo' => 'Encargos trabalhistas',
                                        'valor' => round($totalTaxes / $totalRegistros, 2),
                                        'icone' => 'request_quote',
                                    ],
                                    [
                                        'titulo' => 'Saúde e Segurança no Trabalho',
                                        'valor' => round($totalSST / $totalRegistros, 2),
                                        'icone' => 'security',
                                    ],
                                ];
                            } else {
                                // Caso não haja registros, definir valores como 0
                                $habilitacoes = [
                                    ['titulo' => 'Folha de pagamento', 'valor' => 0, 'icone' => 'receipt_long'],
                                    ['titulo' => 'Jornada de trabalho', 'valor' => 0, 'icone' => 'schedule'],
                                    ['titulo' => 'Encargos trabalhistas', 'valor' => 0, 'icone' => 'request_quote'],
                                    ['titulo' => 'Saúde e Segurança no Trabalho', 'valor' => 0, 'icone' => 'security'],
                                ];
                            }

                            $media = 50;
                        @endphp

                        @foreach ($habilitacoes as $habilitacao)
                            @php
                                $bgColor =
                                    $habilitacao['valor'] >= $media
                                        ? 'bg-gradient-success shadow-success'
                                        : 'bg-gradient-danger shadow-danger';
                            @endphp
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card {{ $bgColor }}">
                                    <div class="card-header p-3 pt-2 d-flex align-items-center justify-content-between">
                                        <div
                                            class="icon icon-md icon-shape {{ $bgColor }} text-center border-radius-xl flex-shrink-0">
                                            <i class="material-icons opacity-10">{{ $habilitacao['icone'] }}</i>
                                        </div>
                                        <div class="text-end ms-3">
                                            <p class="text-sm mb-0 text-capitalize text-wrap" style="max-width: 120px;">
                                                {{ $habilitacao['titulo'] }}
                                            </p>
                                            <h4 class="mb-0">{{ number_format($habilitacao['valor'], 0, ',', '.') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <hr class="dark horizontal my-0">
                                    <div class="card-footer p-3">
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @can('isAdmin')
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">

                            </div>
                            <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">

                            </div>
                            <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">
                                {{-- <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center"
                                    href="{{ route('indicatorEmployee.show', $serviceProvider->id) }}">Indicadores</a> --}}
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">
                                <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center"
                                    style="white-space: nowrap;"
                                    href="{{ route('payrollAudit.create', $serviceProvider->id) }}">Adicionar mês</a>
                            </div>
                        </div>
                    @endcan
                    @can('isAdmin')
                        <div class="row">
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Mês</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Ano</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nota Geral</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Ações</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($serviceProvider->payrollAudits as $payrollAudit)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $payrollAudit->MonthName }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $payrollAudit->year }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $payrollAudit->admission_date }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex justify-content-center">

                                                            <a href="{{ route('payrollAudit.visualizar', [$payrollAudit->id]) }}"
                                                                class="btn btn-sm btn-info text-white me-1"
                                                                data-toggle="tooltip"
                                                                data-original-title="Visualizar usuário">
                                                                Visualizar
                                                            </a>

                                                            <a href="{{ route('payrollAudit.edit', [$payrollAudit->id]) }}"
                                                                class="btn btn-sm btn-secondary text-white me-1"
                                                                data-toggle="tooltip"
                                                                data-original-title="Editar Indicador Mensal">
                                                                Editar
                                                            </a>

                                                            <form
                                                                action="{{ route('payrollAudit.destroy', [$payrollAudit->id, $serviceProvider->id]) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger text-white me-1"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Exluir Indicador Mensal">
                                                                    Excluir
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcan


                    @can('isClient')
                        <div class="row">
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Mês</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Ano</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nota Geral</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Ações</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($serviceProvider->payrollAudits as $payrollAudit)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $payrollAudit->client_name }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $payrollAudit->department }}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $payrollAudit->admission_date }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('employees.edit', [$payrollAudit->id, $serviceProvider->id]) }}"
                                                                class="btn btn-sm btn-info text-white" data-toggle="tooltip"
                                                                data-original-title="Visualizar usuário">
                                                                Visualizar
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
