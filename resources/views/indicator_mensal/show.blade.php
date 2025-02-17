<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Indicador Mensal - Adicionar"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-0">
            <div class="card card-body mx-md-4 mt-4">
                <div class="card card-plain h-400 mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center">
                                <h6 class="mb-0">Indicador Mensal - Adicionar</h6>
                            </div>
                        </div>
                    </div>
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

                        <!-- Form Unificado -->
                        <form method="POST" action="{{ route('payrollAudit.payrollAudit') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="tab-content">
                                <!-- Folha de Pagamento -->
                                <div id="folha_pagamento" class="container tab-pane active">
                                    <h1>Folha de Pagamento</h1>
                                    <div class="row">
                                        <input type="text" name="folha_pagamento_dado"
                                            placeholder="Dado da Folha de Pagamento">
                                    </div>
                                </div>

                                <!-- Jornada de Trabalho -->
                                <div id="jornada_trabalho" class="container tab-pane fade">
                                    <h1>Jornada de Trabalho</h1>
                                    <div class="row">
                                        <input type="text" name="jornada_trabalho_dado"
                                            placeholder="Dado da Jornada de Trabalho">
                                    </div>
                                </div>

                                <!-- Encargos Trabalhistas -->
                                <div id="encargo_trabalhista" class="container tab-pane fade">
                                    <h1>Encargos Trabalhistas</h1>
                                    <div class="row">
                                        <input type="text" name="encargo_trabalhista_dado"
                                            placeholder="Dado dos Encargos Trabalhistas">
                                    </div>
                                </div>

                                <!-- Saúde e Segurança no Trabalho -->
                                <div id="saude_seguranca_trabalho" class="container tab-pane fade">
                                    <h1>Saúde e Segurança no Trabalho</h1>
                                    <div class="row">
                                        <input type="text" name="saude_seguranca_dado"
                                            placeholder="Dado da Saúde e Segurança">
                                    </div>
                                </div>
                            </div>

                            <!-- Botões de Ação -->
                            @can('isAdmin')
                                <div class="mt-3 d-flex justify-content-end">
                                    <button type="reset" class="btn btn-light me-2">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            @endcan

                            @can('isClient')
                                <a href="{{ route('service-provider.show', $serviceProvider->id) }}"
                                    class="btn btn-primary">Voltar</a>
                            @endcan
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>
