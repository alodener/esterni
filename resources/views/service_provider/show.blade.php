<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Visualizar Prestadores"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-0">
            <div class="card card-body mx-md-4 mt-4">
                <div class="card card-plain h-100 mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center">
                                <h6 class="mb-3">Visualizar Prestadores</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 mb-4">
                        @php
                            $habilitacoes = [
                                ['titulo' => 'Habilitação Jurídica', 'valor' => 2300, 'icone' => 'gavel'],
                                ['titulo' => 'Habilitação Trabalhista', 'valor' => 3462, 'icone' => 'work'],
                                ['titulo' => 'Habilitação Fiscal', 'valor' => 3462, 'icone' => 'receipt'],
                                ['titulo' => 'Habilitação Econômica', 'valor' => 2462, 'icone' => 'attach_money'],
                            ];
                            $media = 3000; // Defina aqui a média que será usada na condição
                        @endphp

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
                                    <hr class="dark horizontal my-0">
                                    <div class="card-footer p-3">
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 mb-4 mt-4 d-flex justify-content-center align-items-center">
                            <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center" href="{{ route('employees.show', $serviceProviders->id) }}">Funcionários</a>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-4 mt-4 d-flex justify-content-center align-items-center">
                            <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center" href="{{ route('indicator.show', $serviceProviders->id) }}">Indicadores</a>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-4 mt-4 d-flex justify-content-center align-items-center">
                            <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center" href="{{ route('service-provider.create') }}">Ind. Mensal</a>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-4 mt-4 d-flex justify-content-center align-items-center">
                            <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center" href="{{ route('service-provider.create') }}">Ind. Atual</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <x-plugins></x-plugins>

</x-layout>
