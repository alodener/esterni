<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Vizualizar Colaborador'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container py-4">
            <div class="header-card">
                <div class="d-flex justify-content-between align-items-center">
                    {{-- <h3>Onboarding</h3> --}}
                    {{-- <div class="bg-white text-center p-2 rounded">
                        <p class="mb-0 text-dark" id="nota_geral"><b>NOTA GERAL</b></p>
                        <h2 class="text-secondary">7</h2>
                    </div> --}}
                </div>
            </div>

            {{-- NOTE:  Empregado --}}
            <div class="container py-4 px-6">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow rounded-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="rounded p-3 d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px; background-color: #4A34CC; color: white;">
                                        <img src="{{ asset('assets/img/esterni/icon_person.png') }}" width="30" height="30" alt="teste">
                                    </div>
                                    <h5 class="ms-3" style="color: #4A34CC;">Empregado</h5>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr class="text-muted">
                                            <th style="padding-left: 8px">Campo</th>
                                            <th style="padding-left: 8px">Resultado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Nome</strong></td>
                                            <td>{{ $employee->employee_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>CPF</strong></td>
                                            <td>Informação não cadastrada</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contato e-mail</strong></td>
                                            <td>Informação não cadastrada</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contato telefone</strong></td>
                                            <td>Informação não cadastrada</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow rounded-3 d-flex align-items-center justify-content-center"
                            style="height: 100%;">
                            <div class="rounded-circle border border-3"
                                style="width: 150px; height: 150px; overflow: hidden;">
                                <img src="{{ Storage::url($employee->photo ?? 'assets/img/esterni/icone_adicionar_imagem.png') }}"
                                    alt="Foto do colaborador"
                                    class="img-fluid"
                                    style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- NOTE:  Empregador --}}
            <div class="container py-4 px-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow rounded-3">
                            <div class="card-body col-md-8">
                                <div class="d-flex align-items-center">
                                    <div class="rounded p-3 d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px; background-color: #4A34CC; color: white;">
                                        <img src="{{ asset('assets/img/esterni/icon_empregador.png') }}" width="30" height="30" alt="teste">
                                    </div>
                                    <h5 class="ms-3" style="color: #4A34CC;">Empregador</h5>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr class="text-muted">
                                            <th style="padding-left: 8px">Campo</th>
                                            <th style="padding-left: 8px">Resultado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Razão Social</strong></td>
                                            <td>{{ $employee->provider_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>CNPJ</strong></td>
                                            <td>{{ $employee->provider_cnpj }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contato e-mail</strong></td>
                                            <td>Informação não cadastrada</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contato telefone</strong></td>
                                            <td>Informação não cadastrada</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- NOTE:  Dados Contratuais --}}
            <div class="container py-4 px-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow rounded-3">
                            <div class="card-body col-md-8">
                                <div class="d-flex align-items-center">
                                    <div class="rounded p-3 d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px; background-color: #4A34CC; color: white;">
                                        <img src="{{ asset('assets/img/esterni/icon_dados_contratuais.png') }}" width="30" height="30" alt="teste">
                                    </div>
                                    <h5 class="ms-3" style="color: #4A34CC;">Dados Contratuais</h5>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr class="text-muted">
                                            <th style="padding-left: 8px">Campo</th>
                                            <th style="padding-left: 8px">Resultado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Data de Admissão</strong></td>
                                            <td>{{ $employee->admission_date ? $employee->admission_date->format('d/m/Y') :  null }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Data de Demissão </strong></td>
                                            <td>{{ $employee->dismissal_date ? $employee->dismissal_date->format('d/m/Y') :  null  }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Função CBO</strong></td>
                                            <td>{{ $employee->job_title ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Salário</strong></td>
                                            <td>R$ {{ $employee->salary ?? '0'}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Horário de Trabalho</strong></td>
                                            <td>{{ $employee->work_schedule ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Insalubridade</strong></td>
                                            <td>{{ $employee->insalubrity ? 'Sim' : 'Não' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Periculosidade</strong></td>
                                            <td>{{ $employee->dangerousness ? 'Sim' : 'Não' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Adicional Noturno</strong></td>
                                            <td>{{ $employee->night_shift ? 'Sim' : 'Não' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- NOTE:  Dados da Cessão --}}
            <div class="container py-4 px-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow rounded-3">
                            <div class="card-body col-md-8">
                                <div class="d-flex align-items-center">
                                    <div class="rounded p-3 d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px; background-color: #4A34CC; color: white;">
                                        <img src="{{ asset('assets/img/esterni/icon_dados_cessao.png') }}" width="30" height="30" alt="teste">
                                    </div>
                                    <h5 class="ms-3" style="color: #4A34CC;">Dados da Cessão</h5>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr class="text-muted">
                                            <th style="padding-left: 8px">Campo</th>
                                            <th style="padding-left: 8px">Resultado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Tomador</strong></td>
                                            <td>{{ $employee->serviceProvider->company_name ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Setor</strong></td>
                                            <td>{{ $employee->department ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Início da Cessão</strong></td>
                                            <td>{{ $employee->start_client_allocation ? $employee->start_client_allocation->format('d/m/Y') :  null }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Término da Cessão</strong></td>
                                            <td>{{ $employee->end_client_allocation ? $employee->end_client_allocation->format('d/m/Y') :  null }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Habilitação em Sistema</strong></td>
                                            <td>{{ $employee->system_enable_date ? $employee->system_enable_date->format('d/m/Y') :  null }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container py-4 px-6">
                <a class="btn btn-primary" href="{{ route('employees.show', $employee->serviceProvider->id) }}">voltar</a>
            </div>
        </div>
    </div>

    <style>
        .header-card {
            background: url("{{ asset('assets/img/esterni/ficha_trabalhador_terceirizado_banner.png') }}") no-repeat center center;
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
                height: 100px;
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
        <!-- Adicionando IMask.js via CDN -->
        <script src="https://unpkg.com/imask"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var input = document.getElementById("salary");

                var maskOptions = {
                    mask: "R$ num", // Adiciona o prefixo "R$ "
                    blocks: {
                        num: {
                            mask: Number,
                            scale: 2, // Duas casas decimais
                            thousandsSeparator: "", // Separador de milhar
                            radix: ".", // Separador decimal
                            mapToRadix: [","], // Mapeia "," para o separador decimal
                            padFractionalZeros: true, // Garante duas casas decimais
                            normalizeZeros: true
                        }
                    }
                };

                IMask(input, maskOptions);
            });
        </script>
    @endpush

</x-layout>
