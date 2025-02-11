<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Funcionário"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-0">
            <div class="card card-body mx-md-4 mt-4">
                <div class="card card-plain h-400 mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center">
                                <h6 class="mb-0">Indicador Empresa</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row container">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-fill mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#contratual">Contratual Empregados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#ocupacionais">Programas Ocupacionais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#fiscal">Habilitação Fiscal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#economica">Habilitação Econômica</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div id="contratual" class="container tab-pane active">
                                <h1>contratual</h1>
                                <form method="POST" action="{{ route('indicator.updateOrCreateLegalCertification') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                class="form-select border border-2 p-2" required readonly>
                                                <option selected="selected" value="{{ $serviceProvider->id }}" readonly>
                                                    {{ $serviceProvider->company_name }}
                                                </option>
                                            </select>
                                            @error('service_provider_id')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="cnpj_card" class="form-label">Cartão de CNPJ</label>
                                            <input type="text" name="cnpj_card" id="cnpj_card"
                                                value="{{ old('cnpj_card', $serviceProvider->legalCertification?->cnpj_card) }}"
                                                class="form-control border border-2 p-2">
                                            @error('cnpj_card')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="incorporation_act" class="form-label">Ato Constitutivo, Estatuto ou Contrato Social</label>
                                            <input type="text" name="incorporation_act" id="incorporation_act"
                                                value="{{ old('incorporation_act', $serviceProvider->legalCertification?->incorporation_act) }}"
                                                class="form-control border border-2 p-2">
                                            @error('incorporation_act')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="partners_identification" class="form-label">RG, CPF dos Sócios e Administradores</label>
                                            <input type="text" name="partners_identification" id="partners_identification"
                                                value="{{ old('partners_identification', $serviceProvider->legalCertification?->partners_identification) }}"
                                                class="form-control border border-2 p-2">
                                            @error('partners_identification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="operating_license" class="form-label">Alvará de Funcionamento</label>
                                            <input type="text" name="operating_license" id="operating_license"
                                                value="{{ old('operating_license', $serviceProvider->legalCertification?->operating_license) }}"
                                                class="form-control border border-2 p-2">
                                            @error('operating_license')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="ocupacionais" class="container tab-pane fade">
                                <h1>ocupacionais</h1>
                                <form method="POST" action="{{ route('indicator.updateOrCreateLaborCertification') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                    </div>
                                </form>
                            </div>

                            <div id="fiscal" class="container tab-pane fade">
                                <h1>fiscal</h1>
                                <form method="POST" action="{{ route('indicator.updateOrCreateFiscalCertification') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                    </div>
                                </form>
                            </div>

                            <div id="economica" class="container tab-pane fade">
                                <h1>economica</h1>
                                <form method="POST" action="{{ route('indicator.updateOrCreateEconomicCertification') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="mt-3 d-flex justify-content-end">
                            <button class="btn btn-light me-2">Cancelar</button>
                            <button class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>
