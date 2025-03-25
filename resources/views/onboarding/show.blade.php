<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Lista Prestadores"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="header-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Onboarding</h3>
                    <div class="bg-white text-center p-2 rounded">
                        <p class="mb-0 text-dark" id="nota_geral"><b>NOTA GERAL</b></p>
                        <h2 class="text-secondary">{{ $serviceProvider->getPontuacaoGeralAttribute()  }}</h2>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><strong>Local e Data</strong></td>
                            <td>{{ $serviceProvider->company_opening_date }}</td>
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
                        <tr>
                            <td><strong>Início/Término do Contrato</strong></td>
                            <td>{{ $serviceProvider->contract_start_date }} / {{ $serviceProvider->contract_end_date }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Serviço Prestado</strong></td>
                            <td>{{ $serviceProvider->service_provided }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nº Colaboradores Contratados</strong></td>
                            <td>{{ $serviceProvider->number_of_contracted_employees }}</td>
                        </tr>
                    </table>


                </div>

            </div>

            @php
                $habilitacoes = [
                    [
                        'titulo' => 'Habilitação Jurídica',
                        'valor' => round($serviceProvider->getLegalCertificationAverageScoreAttribute()),
                        'icone' => 'habilitacao_juridica.png',
                    ],
                    [
                        'titulo' => 'Habilitação Trabalhista',
                        'valor' => round($serviceProvider->getLaborCertificationAverageScoreAttribute()),
                        'icone' => 'habilitacao_trabalhista.png',
                    ],
                    [
                        'titulo' => 'Habilitação Fiscal',
                        'valor' => round($serviceProvider->getFiscalCertificationAverageScoreAttribute()),
                        'icone' => 'habilitacao_fiscal.png',
                    ],
                    [
                        'titulo' => 'Habilitação Econômica',
                        'valor' => round($serviceProvider->getEconomicCertificationAverageScoreAttribute()),
                        'icone' => 'habilitacao_economica.png',
                    ],
                ];
                $media = 50; // Defina aqui a média que será usada na condição
            @endphp
            <div class="row mt-5">
                <h3><strong>Visão Empresarial</strong></h3>
                @foreach ($habilitacoes as $habilitacao)
                    @php
                        // Definir cor com base no valor
                        if ($habilitacao['valor'] > 70) {
                            $bgColor = '#10D8A0'; // Verde
                        } elseif ($habilitacao['valor'] > 50) {
                            $bgColor = '#F6D118'; // Amarelo
                        } else {
                            $bgColor = '#E91F63'; // Vermelho
                        }
                    @endphp
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 pt-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2 ">
                                <div class="d-flex justify-content-center align-items-center icon icon-md icon-shape {{ $bgColor }} text-center border-radius-xl mt-n4 position-absolute"
                                    style="background-image: linear-gradient(195deg, {{ $bgColor }} 0%, {{ $bgColor }} 100%); width: 65px; height: 65px">
                                    {{-- <i class="material-icons opacity-10">{{ $habilitacao['icone'] }}</i> --}}
                                    <img src="{{ asset('assets/img/esterni/visao_empresarial/' . $habilitacao['icone']) }}"
                                        alt="{{ $habilitacao['titulo'] }}" style="width: 35px; height: auto;">
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-md mb-0 text-capitalize">
                                        @foreach (explode(' ', $habilitacao['titulo']) as $palavra)
                                            <span style="display: block;"><strong>{{ $palavra }}</strong></span>
                                        @endforeach
                                    </p>
                                    <h4 class="mb-0 text-center"
                                        style="margin-top: 5px; color: {{ $bgColor }}; font-size: 40px !important">
                                        {{ number_format($habilitacao['valor'], 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            {{-- <hr class="dark horizontal my-0"> --}}
                            <div class="card-footer pa-0 ma-0" style="padding: 4px">
                                {{-- <p class="mb-0"></p> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card mt-7">
                <div class="card-body mt-n6">
                    <div class="chart-container p-3" style="background: #2c2cd6; border-radius: 10px;">
                        <canvas id="barChart"></canvas>
                    </div>
                    <h5 class="mt-3 ms-3"><strong>Análise Empresarial</strong></h5>
                </div>
            </div>

            @php
                $habilitacoesTrabalhista = [
                    [
                        'titulo' => 'Documentação Contratual',
                        'valor' => round($serviceProvider->getContractualDocumentationScoreAttribute()),
                        'icone' => 'documentacao_contratual.png',
                    ],
                    [
                        'titulo' => 'Programas Ocupacionais',
                        'valor' => round($serviceProvider->getOccupationalProgramsScoreAttribute()),
                        'icone' => 'programas_ocupacionais.png',
                    ],
                    [
                        'titulo' => 'Saúde e Segurança no Trabalho (SST)',
                        'valor' => round($serviceProvider->getOccupationalHealthSafetyScoreAttribute()),
                        'icone' => 'saude_seguranca.png',
                    ],
                    [
                        'titulo' => 'Treinamentos Ocupacionais',
                        'valor' => round($serviceProvider->getOccupationalTrainingsScoreAttribute()),
                        'icone' => 'treinamento_ocupacionais.png',
                    ],
                ];

                $media = 50;
            @endphp
            <div class="row mt-5">
                <h3><strong>Visão Trabalhista</strong></h3>
                @foreach ($habilitacoesTrabalhista as $habilitacao)
                    @php
                        // Definir cor com base no valor
                        if ($habilitacao['valor'] > 70) {
                            $bgColor = '#10D8A0'; // Verde
                        } elseif ($habilitacao['valor'] > 50) {
                            $bgColor = '#F6D118'; // Amarelo
                        } else {
                            $bgColor = '#E91F63'; // Vermelho
                        }
                    @endphp
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 pt-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2 ">
                                <div class="d-flex justify-content-center align-items-center icon icon-md icon-shape {{ $bgColor }} text-center border-radius-xl mt-n4 position-absolute"
                                    style="background-image: linear-gradient(195deg, {{ $bgColor }} 0%, {{ $bgColor }} 100%); width: 65px; height: 65px">
                                    {{-- <i class="material-icons opacity-10">{{ $habilitacao['icone'] }}</i> --}}
                                    <img src="{{ asset('assets/img/esterni/visao_trabalhista/' . $habilitacao['icone']) }}"
                                        alt="{{ $habilitacao['titulo'] }}" style="width: 35px; height: auto;">
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-md mb-0 text-capitalize">
                                        @if ($habilitacao['titulo'] == 'Saúde e Segurança no Trabalho (SST)')
                                            <span style="display: block;"><strong>Saúde e Segurança no<br>Trabalho
                                                    (SST)</strong></span>
                                        @else
                                            @foreach (explode(' ', $habilitacao['titulo']) as $palavra)
                                                <span
                                                    style="display: block;"><strong>{{ $palavra }}</strong></span>
                                            @endforeach
                                        @endif
                                    </p>
                                    <h4 class="mb-0 text-center"
                                        style="margin-top: 5px; color: {{ $bgColor }}; font-size: 40px !important">
                                        {{ number_format($habilitacao['valor'], 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            {{-- <hr class="dark horizontal my-0"> --}}
                            <div class="card-footer pa-0 ma-0" style="padding: 4px">
                                {{-- <p class="mb-0"></p> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card mt-7">
                <div class="card-body mt-n6">
                    <div class="chart-container p-3" style="background: #2c2cd6; border-radius: 10px;">
                        <canvas id="barChartTrabalhista"></canvas>
                    </div>
                    <h5 class="mt-3 ms-3"><strong>Análise Trabalhista</strong></h5>
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const habilitacoes = @json($habilitacoes);

                const labels = habilitacoes.map(h => h.titulo);
                const data = habilitacoes.map(h => h.valor);
                const backgroundColor = habilitacoes.map(h => {
                    if (h.valor > 70) {
                        return '#10D8A0'; // Verde
                    } else if (h.valor > 50) {
                        return '#F6D118'; // Amarelo
                    } else {
                        return '#E91F63'; // Vermelho
                    }
                });

                const ctx = document.getElementById('barChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Habilitação Jurídica', 'Habilitação Trabalhista', 'Habilitação Fiscal',
                            'Habilitação Econômica'
                        ],
                        datasets: [{
                            data: data, // Valores das barras
                            backgroundColor: backgroundColor, // Cores das barras
                            borderRadius: 5,
                            barPercentage: 0.4, // Reduz a largura das barras (0.1 a 1.0, onde 1.0 é o tamanho padrão)
                            categoryPercentage: 0.5 // Define o espaçamento entre as barras (ajuste para testar)
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    color: '#fff'
                                },
                                grid: {
                                    color: 'rgba(255,255,255,0.3)',
                                    borderDash: [5, 5]
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#fff'
                                },
                                grid: {
                                    display: false
                                },
                                barPercentage: 2.0, // Reduz a largura das barras (padrão é 1.0)
                                categoryPercentage: 0.1 // Ajusta o espaçamento entre as barras
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const habilitacoes = @json($habilitacoesTrabalhista);

                const labels = habilitacoes.map(h => h.titulo);
                const data = habilitacoes.map(h => h.valor);
                const backgroundColor = habilitacoes.map(h => {
                    if (h.valor > 70) {
                        return '#10D8A0'; // Verde
                    } else if (h.valor > 50) {
                        return '#F6D118'; // Amarelo
                    } else {
                        return '#E91F63'; // Vermelho
                    }
                });

                const ctx = document.getElementById('barChartTrabalhista').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Documentação Contratual', 'Programas Ocupacionais', 'Saúde e Segurança no Trabalho (SST)',
                            'Treinamentos Ocupacionais'
                        ],
                        datasets: [{
                            data: data, // Valores das barras
                            backgroundColor: backgroundColor, // Cores das barras
                            borderRadius: 5,
                            barPercentage: 0.4, // Reduz a largura das barras (0.1 a 1.0, onde 1.0 é o tamanho padrão)
                            categoryPercentage: 0.5 // Define o espaçamento entre as barras (ajuste para testar)
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    color: '#fff'
                                },
                                grid: {
                                    color: 'rgba(255,255,255,0.3)',
                                    borderDash: [5, 5]
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#fff'
                                },
                                grid: {
                                    display: false
                                },
                                barPercentage: 2.0, // Reduz a largura das barras (padrão é 1.0)
                                categoryPercentage: 0.1 // Ajusta o espaçamento entre as barras
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-layout>
