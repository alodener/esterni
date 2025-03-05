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
                    <h3>Folha 13º</h3>
                    <div class="bg-white text-center p-2 rounded">
                        <p class="mb-0 text-dark" id="nota_geral"><b>NOTA GERAL</b></p>
                        <h2 class="text-secondary">7</h2>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <table class="table">
                        <tr><td><strong>Local e Data</strong></td><td>{{ $serviceProvider->company_opening_date }}</td></tr>
                        <tr><td><strong>Tomador</strong></td><td>{{ $serviceProvider->company_name }}</td></tr>
                        <tr><td><strong>Prestador</strong></td><td>{{ $serviceProvider->social_purpose }}</td></tr>
                        <tr><td><strong>CNPJ do Prestador</strong></td><td>{{ $serviceProvider->provider_cnpj }}</td></tr>
                        <tr><td><strong>Início/Término do Contrato</strong></td><td>{{ $serviceProvider->contract_start_date }} / {{ $serviceProvider->contract_end_date }}</td></tr>
                        <tr><td><strong>Serviço Prestado</strong></td><td>{{  $serviceProvider->service_provided }}</td></tr>
                        <tr><td><strong>Nº Empregados Contratados</strong></td><td>{{  $serviceProvider->number_of_contracted_employees }}</td></tr>
                    </table>


                </div>

            </div>

            @php
                $habilitacoes = [
                    ['titulo' => 'Habilitação Jurídica', 'valor' => $serviceProvider->getLegalCertificationAverageScoreAttribute(), 'icone' => 'gavel'],
                    ['titulo' => 'Habilitação Trabalhista', 'valor' => $serviceProvider->getLaborCertificationAverageScoreAttribute(), 'icone' => 'work'],
                    ['titulo' => 'Habilitação Fiscal', 'valor' => $serviceProvider->getFiscalCertificationAverageScoreAttribute(), 'icone' => 'receipt'],
                    ['titulo' => 'Habilitação Econômica', 'valor' => $serviceProvider->getEconomicCertificationAverageScoreAttribute(), 'icone' => 'attach_money'],
                ];
                $media = 50; // Defina aqui a média que será usada na condição
            @endphp
            <div class="row mt-5">
                <h3><strong>Visão Empresarial</strong></h3>
                @foreach ($habilitacoes as $habilitacao)
                    @php
                        $bgColor = $habilitacao['valor'] >= $media ? 'bg-gradient-success shadow-success' : 'bg-gradient-danger shadow-danger';
                    @endphp
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card {{ $bgColor }}">
                            <div class="card-header p-3 pt-2 ">
                                <div class="icon icon-md icon-shape {{ $bgColor }} text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">{{ $habilitacao['icone'] }}</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">{{ $habilitacao['titulo'] }}</p>
                                    <h4 class="mb-0">{{ number_format($habilitacao['valor'], 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            {{-- <hr class="dark horizontal my-0"> --}}
                            <div class="card-footer p-3">
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </div>
                @endforeach
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
            h3{
                margin-left: 40px;
                color: white;
            }
            div{
                margin-right: 25px;
            }

            div{
                #nota_geral{
                    width: 100px;
                    font-size: 12px;
                }
            }

            div{
                #nota_geral{
                    width: 100px;
                    font-size: 12px;
                }
            }
        }

    </style>
</x-layout>
