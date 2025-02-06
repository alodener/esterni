<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Funcionário"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-0">
            <div class="card card-body mx-md-4 mt-4">
                <div class="card card-plain h-100 mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center">
                                <h6 class="mb-0">Funcionário</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-0 mb-2">
                        @php
                            $habilitacoes = [
                                ['titulo' => 'Documentação Contratual', 'valor' => 2300, 'icone' => 'description'],
                                ['titulo' => 'Programas Ocupacionais', 'valor' => 3462, 'icone' => 'business_center'],
                                [
                                    'titulo' => 'Saúde e Segurança Ocupacional',
                                    'valor' => 3462,
                                    'icone' => 'health_and_safety',
                                ],
                                ['titulo' => 'Treinamentos Ocupacionais', 'valor' => 2462, 'icone' => 'school'],
                            ];

                            $media = 3000;
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
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">

                        </div>
                        <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">

                        </div>
                        <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">
                            <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center"
                                href="">Indicadores</a>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-1 mt-1 d-flex justify-content-center align-items-center">
                            <a class="btn bg-gradient-dark btn-lg px-5 py-3 w-100 text-center"
                            style="white-space: nowrap;"
                                href="{{ route('employees.create', $serviceProvider->id) }}">Novos Funcionários</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nome</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Setor Lotado</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Dt Adimissão</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Ações</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($serviceProvider->employees as $employee)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $employee->client_name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $employee->department }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $employee->admission_date }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('employees.edit', [$employee->id, $serviceProvider->id]) }}"
                                                           class="btn btn-sm btn-secondary text-white me-1"
                                                           data-toggle="tooltip"
                                                           data-original-title="Editar usuário">
                                                            Editar
                                                        </a>

                                                        <form action="{{ route('employees.destroy', [$employee->id, $serviceProvider->id]) }}"
                                                              method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-danger text-white me-1"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Exluir usuário">
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
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
