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
                                <a class="nav-link active" data-bs-toggle="tab" href="#contratual">Contratual
                                    Empregados</a>
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
                                <form method="POST" action="{{ route('indicator.updateOrCreateLegalCertification') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
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
                                            <select name="cnpj_card" id="cnpj_card"
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('cnpj_card', $serviceProvider->legalCertification?->cnpj_card) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('cnpj_card', $serviceProvider->legalCertification?->cnpj_card) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('cnpj_card', $serviceProvider->legalCertification?->cnpj_card) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('cnpj_card')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="incorporation_act" class="form-label">Ato Constitutivo, Estatuto
                                                ou Contrato Social</label>
                                            <select name="incorporation_act" id="incorporation_act"
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('incorporation_act', $serviceProvider->legalCertification?->incorporation_act) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('incorporation_act', $serviceProvider->legalCertification?->incorporation_act) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('incorporation_act', $serviceProvider->legalCertification?->incorporation_act) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('incorporation_act')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="partners_identification" class="form-label">RG, CPF dos Sócios e
                                                Administradores</label>
                                            <select name="partners_identification" id="partners_identification"
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('partners_identification', $serviceProvider->legalCertification?->partners_identification) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('partners_identification', $serviceProvider->legalCertification?->partners_identification) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('partners_identification', $serviceProvider->legalCertification?->partners_identification) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('partners_identification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="operating_license" class="form-label">Alvará de
                                                Funcionamento</label>
                                            <select name="operating_license" id="operating_license"
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('operating_license', $serviceProvider->legalCertification?->operating_license) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('operating_license', $serviceProvider->legalCertification?->operating_license) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('operating_license', $serviceProvider->legalCertification?->operating_license) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('operating_license')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Botões de Ação -->
                                    <div class="mt-3 d-flex justify-content-end">
                                        <button class="btn btn-light me-2">Cancelar</button>
                                        <button class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>

                            <div id="ocupacionais" class="container tab-pane fade">
                                <h1>ocupacionais</h1>
                                <form method="POST" action="{{ route('indicator.updateOrCreateLaborCertification') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 col-md-6">
                                        <label for="retention_clause" class="form-label">Cláusula de Retenção</label>
                                        <select name="retention_clause" id="retention_clause" class="form-select border border-2 p-2">
                                            <option value="Conforme" {{ old('retention_clause', $serviceProvider->laborCertification?->retention_clause) == 'Conforme' ? 'selected' : '' }}>Conforme</option>
                                            <option value="Não Conforme" {{ old('retention_clause', $serviceProvider->laborCertification?->retention_clause) == 'Não Conforme' ? 'selected' : '' }}>Não Conforme</option>
                                            <option value="Conforme Parcialmente" {{ old('retention_clause', $serviceProvider->laborCertification?->retention_clause) == 'Conforme Parcialmente' ? 'selected' : '' }}>Conforme Parcialmente</option>
                                        </select>
                                        @error('retention_clause')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                </form>
                            </div>

                            <div id="fiscal" class="container tab-pane fade">
                                <h1>fiscal</h1>
                                <form method="POST"
                                    action="{{ route('indicator.updateOrCreateFiscalCertification') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                class="form-select border border-2 p-2" required readonly>
                                                <option selected="selected" value="{{ $serviceProvider->id }}"
                                                    readonly>
                                                    {{ $serviceProvider->company_name }}</option>
                                            </select>
                                            @error('service_provider_id')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="federal_tax_certification" class="form-label">Certidão de
                                                Regularidade de Tributos Federais</label>
                                            <input type="text" name="federal_tax_certification"
                                                id="federal_tax_certification"
                                                value="{{ old('federal_tax_certification', $serviceProvider->fiscalCertification?->federal_tax_certification) }}"
                                                class="form-control border border-2 p-2">
                                            @error('federal_tax_certification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="state_tax_certification" class="form-label">Certidão de
                                                Regularidade de Tributos Estaduais</label>
                                            <input type="text" name="state_tax_certification"
                                                id="state_tax_certification"
                                                value="{{ old('state_tax_certification', $serviceProvider->fiscalCertification?->state_tax_certification) }}"
                                                class="form-control border border-2 p-2">
                                            @error('state_tax_certification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="municipal_tax_certification" class="form-label">Certidão de
                                                Regularidade de Tributos Municipais</label>
                                            <input type="text" name="municipal_tax_certification"
                                                id="municipal_tax_certification"
                                                value="{{ old('municipal_tax_certification', $serviceProvider->fiscalCertification?->municipal_tax_certification) }}"
                                                class="form-control border border-2 p-2">
                                            @error('municipal_tax_certification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="cnd_federal_debt" class="form-label">CND - Certidão Negativa
                                                de Débitos Relativos aos Tributos Federais e à Dívida Ativa da
                                                União</label>
                                            <input type="text" name="cnd_federal_debt" id="cnd_federal_debt"
                                                value="{{ old('cnd_federal_debt', $serviceProvider->fiscalCertification?->cnd_federal_debt) }}"
                                                class="form-control border border-2 p-2">
                                            @error('cnd_federal_debt')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div id="economica" class="container tab-pane fade">
                                <h1>economica</h1>
                                <form method="POST"
                                    action="{{ route('indicator.updateOrCreateEconomicCertification') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                class="form-select border border-2 p-2" required readonly>
                                                <option selected="selected" value="{{ $serviceProvider->id }}"
                                                    readonly>
                                                    {{ $serviceProvider->company_name }}</option>
                                            </select>
                                            @error('service_provider_id')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="contract_start_end" class="form-label">Início/Fim do
                                                Contrato</label>
                                            <input type="date" name="contract_start_end" id="contract_start_end"
                                                value="{{ old('contract_start_end', $serviceProvider->economicCertification?->contract_start_end ? $serviceProvider->economicCertification?->contract_start_end->format('Y-m-d') : '') }}"
                                                class="form-control border border-2 p-2" required>
                                            @error('contract_start_end')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="company_size" class="form-label">Porte</label>
                                            <input type="text" name="company_size" id="company_size"
                                                value="{{ old('company_size', $serviceProvider->economicCertification?->company_size) }}"
                                                class="form-control border border-2 p-2" required>
                                            @error('company_size')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="calculation_memory" class="form-label">Memória de
                                                Cálculo</label>
                                            <input type="text" name="calculation_memory" id="calculation_memory"
                                                value="{{ old('calculation_memory', $serviceProvider->economicCertification?->calculation_memory) }}"
                                                class="form-control border border-2 p-2" required>
                                            @error('calculation_memory')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="bankruptcy_certificate" class="form-label">Certidão Negativa
                                                de Falência e Protesto</label>
                                            <input type="text" name="bankruptcy_certificate"
                                                id="bankruptcy_certificate"
                                                value="{{ old('bankruptcy_certificate', $serviceProvider->economicCertification?->bankruptcy_certificate) }}"
                                                class="form-control border border-2 p-2" required>
                                            @error('bankruptcy_certificate')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="dre_balance_sheet" class="form-label">DRE/Balancete</label>
                                            <input type="text" name="dre_balance_sheet" id="dre_balance_sheet"
                                                value="{{ old('dre_balance_sheet', $serviceProvider->economicCertification?->dre_balance_sheet) }}"
                                                class="form-control border border-2 p-2" required>
                                            @error('dre_balance_sheet')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="issues_invoice" class="form-label">Emite Nota Fiscal?</label>
                                            <select name="issues_invoice" id="issues_invoice"
                                                class="form-select border border-2 p-2" required>
                                                <option value="1"
                                                    {{ old('issues_invoice', $serviceProvider->economicCertification?->issues_invoice) == 1 ? 'selected' : '' }}>
                                                    Sim</option>
                                                <option value="0"
                                                    {{ old('issues_invoice', $serviceProvider->economicCertification?->issues_invoice) == 0 ? 'selected' : '' }}>
                                                    Não</option>
                                            </select>
                                            @error('issues_invoice')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>
