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
                                <h6 class="mb-0">Indicador Funcionário</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row container">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-fill mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#contratual">Documentação
                                    Contratual dos Empregados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#ocupacionais">Programas Ocupacionais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#segurança_ocupacional">Saúde e Segurança
                                    Ocupacional</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#treinamentos_ocupacionais">Treinamentos
                                    Ocupacionais</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">

                            {{-- NOTE: Habilitação Jurídica --}}
                            <div id="contratual" class="container tab-pane active">
                                <h1>Habilitação Jurídica</h1>
                                <form method="POST" action="{{ route('indicatorEmployee.employeeContractualDocs') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="mb-3 col-md-6">
                                            <label for="admission_protocol" class="form-label">Protocolo de
                                                Admissão</label>
                                            <select name="admission_protocol" id="admission_protocol"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('admission_protocol', $serviceProvider->contractualDocumentation?->admission_protocol) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('admission_protocol', $serviceProvider->contractualDocumentation?->admission_protocol) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('admission_protocol', $serviceProvider->contractualDocumentation?->admission_protocol) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('admission_protocol', $serviceProvider->contractualDocumentation?->admission_protocol) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('admission_protocol')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="employment_contract" class="form-label">Contrato de
                                                Trabalho</label>
                                            <select name="employment_contract" id="employment_contract"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('employment_contract', $serviceProvider->contractualDocumentation?->employment_contract) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('employment_contract', $serviceProvider->contractualDocumentation?->employment_contract) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('employment_contract', $serviceProvider->contractualDocumentation?->employment_contract) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('employment_contract', $serviceProvider->contractualDocumentation?->employment_contract) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('employment_contract')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="ethics_code" class="form-label">Código de Ética e
                                                Conduta</label>
                                            <select name="ethics_code" id="ethics_code"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('ethics_code', $serviceProvider->contractualDocumentation?->ethics_code) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('ethics_code', $serviceProvider->contractualDocumentation?->ethics_code) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('ethics_code', $serviceProvider->contractualDocumentation?->ethics_code) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('ethics_code', $serviceProvider->contractualDocumentation?->ethics_code) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('ethics_code')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="driver_license" class="form-label">CNH - Para Motoristas</label>
                                            <select name="driver_license" id="driver_license"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('driver_license', $serviceProvider->contractualDocumentation?->driver_license) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('driver_license', $serviceProvider->contractualDocumentation?->driver_license) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('driver_license', $serviceProvider->contractualDocumentation?->driver_license) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('driver_license', $serviceProvider->contractualDocumentation?->driver_license) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('driver_license')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="federal_police_clearance" class="form-label">Alvará da Polícia
                                                Federal</label>
                                            <select name="federal_police_clearance" id="federal_police_clearance"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('federal_police_clearance', $serviceProvider->contractualDocumentation?->federal_police_clearance) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('federal_police_clearance', $serviceProvider->contractualDocumentation?->federal_police_clearance) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('federal_police_clearance', $serviceProvider->contractualDocumentation?->federal_police_clearance) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('federal_police_clearance', $serviceProvider->contractualDocumentation?->federal_police_clearance) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('federal_police_clearance')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="professional_council_certificate" class="form-label">Certidão de
                                                Registro no Conselho de Classe</label>
                                            <select name="professional_council_certificate"
                                                id="professional_council_certificate" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('professional_council_certificate', $serviceProvider->contractualDocumentation?->professional_council_certificate) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('professional_council_certificate', $serviceProvider->contractualDocumentation?->professional_council_certificate) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('professional_council_certificate', $serviceProvider->contractualDocumentation?->professional_council_certificate) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('professional_council_certificate', $serviceProvider->contractualDocumentation?->professional_council_certificate) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('professional_council_certificate')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="electrical_course_certificate" class="form-label">Certificado
                                                de Curso de Elétrica</label>
                                            <select name="electrical_course_certificate"
                                                id="electrical_course_certificate" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('electrical_course_certificate', $serviceProvider->contractualDocumentation?->electrical_course_certificate) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('electrical_course_certificate', $serviceProvider->contractualDocumentation?->electrical_course_certificate) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('electrical_course_certificate', $serviceProvider->contractualDocumentation?->electrical_course_certificate) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('electrical_course_certificate', $serviceProvider->contractualDocumentation?->electrical_course_certificate) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('electrical_course_certificate')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="collective_agreement" class="form-label">CCT ou ACT</label>
                                            <select name="collective_agreement" id="collective_agreement"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('collective_agreement', $serviceProvider->contractualDocumentation?->collective_agreement) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('collective_agreement', $serviceProvider->contractualDocumentation?->collective_agreement) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('collective_agreement', $serviceProvider->contractualDocumentation?->collective_agreement) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('collective_agreement', $serviceProvider->contractualDocumentation?->collective_agreement) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('collective_agreement')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    @can('isAdmin')
                                        <div class="mt-3 d-flex justify-content-end">
                                            <a href="{{ route('service-provider.show', $serviceProvider->id) }}"
                                                class="btn btn-primary">Voltar</a>
                                            <button class="btn btn-primary">Salvar</button>
                                        </div>
                                    @endcan
                                    @can('isClient')
                                        <a href="{{ route('service-provider.show', $serviceProvider->id) }}"
                                            class="btn btn-primary">Voltar</a>
                                    @endcan
                                </form>


                            </div>

                            {{-- NOTE: Habilitação Trabalhista --}}
                            <div id="ocupacionais" class="container tab-pane fade">
                                <h1>Habilitação Trabalhista</h1>
                                <form method="POST"
                                    action="{{ route('indicator.updateOrCreateLaborCertification') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                @can('isClient') disabled @endcan
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
                                            <label for="risk_level" class="form-label">Grau de Risco</label>
                                            <input type="number" name="risk_level" id="risk_level"
                                                @can('isClient') disabled @endcan
                                                value="{{ old('risk_level', $serviceProvider->laborCertification?->risk_level) }}"
                                                class="form-control border border-2 p-2">
                                            @error('risk_level')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="share_capital" class="form-label">Capital Social</label>
                                            <select name="share_capital" id="share_capital"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('share_capital', $serviceProvider->laborCertification?->share_capital) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('share_capital', $serviceProvider->laborCertification?->share_capital) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('share_capital', $serviceProvider->laborCertification?->share_capital) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('share_capital')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="employees_number" class="form-label">Nº de Empregados</label>
                                            <input type="number" name="employees_number" id="employees_number"
                                                @can('isClient') disabled @endcan
                                                value="{{ old('employees_number', $serviceProvider->laborCertification?->employees_number) }}"
                                                class="form-control border border-2 p-2">
                                            @error('employees_number')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="capital_per_employee" class="form-label">Proporção
                                                Capital/Empregados</label>
                                            <input type="text" name="capital_per_employee"
                                                @can('isClient') disabled @endcan id="capital_per_employee"
                                                value="{{ old('capital_per_employee', $serviceProvider->laborCertification?->capital_per_employee) }}"
                                                class="form-control border border-2 p-2">
                                            @error('capital_per_employee')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="retention_clause" class="form-label">Cláusula de
                                                Retenção</label>
                                            <select name="retention_clause" id="retention_clause"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('retention_clause', $serviceProvider->laborCertification?->retention_clause) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('retention_clause', $serviceProvider->laborCertification?->retention_clause) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('retention_clause', $serviceProvider->laborCertification?->retention_clause) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('retention_clause')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="fgts_certificate" class="form-label">Certidão de FGTS</label>
                                            <select name="fgts_certificate" id="fgts_certificate"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('fgts_certificate', $serviceProvider->laborCertification?->fgts_certificate) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('fgts_certificate', $serviceProvider->laborCertification?->fgts_certificate) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('fgts_certificate', $serviceProvider->laborCertification?->fgts_certificate) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('fgts_certificate')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="labor_certificate" class="form-label">Certidão
                                                Trabalhista</label>
                                            <select name="labor_certificate" id="labor_certificate"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('labor_certificate', $serviceProvider->laborCertification?->labor_certificate) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('labor_certificate', $serviceProvider->laborCertification?->labor_certificate) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('labor_certificate', $serviceProvider->laborCertification?->labor_certificate) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('labor_certificate')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    @can('isAdmin')
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button class="btn btn-light me-2">Cancelar</button>
                                            <button class="btn btn-primary">Salvar</button>
                                        </div>
                                    @endcan

                                    @can('isClient')
                                        <a href="{{ route('service-provider.show', $serviceProvider->id) }}"
                                            class="btn btn-primary">Voltar</a>
                                    @endcan
                                </form>
                            </div>

                            {{-- NOTE: Habilitação Fiscal --}}
                            <div id="fiscal" class="container tab-pane fade">
                                <h1>Habilitação Fiscal</h1>
                                <form method="POST"
                                    action="{{ route('indicator.updateOrCreateFiscalCertification') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                @can('isClient') disabled @endcan
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
                                            <select name="federal_tax_certification" id="federal_tax_certification"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('federal_tax_certification', $serviceProvider->fiscalCertification?->federal_tax_certification) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('federal_tax_certification', $serviceProvider->fiscalCertification?->federal_tax_certification) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('federal_tax_certification', $serviceProvider->fiscalCertification?->federal_tax_certification) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('federal_tax_certification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="state_tax_certification" class="form-label">Certidão de
                                                Regularidade de Tributos Estaduais</label>
                                            <select name="state_tax_certification" id="state_tax_certification"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('state_tax_certification', $serviceProvider->fiscalCertification?->state_tax_certification) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('state_tax_certification', $serviceProvider->fiscalCertification?->state_tax_certification) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('state_tax_certification', $serviceProvider->fiscalCertification?->state_tax_certification) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('state_tax_certification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="municipal_tax_certification" class="form-label">Certidão de
                                                Regularidade de Tributos Municipais</label>
                                            <select name="municipal_tax_certification"
                                                id="municipal_tax_certification" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('municipal_tax_certification', $serviceProvider->fiscalCertification?->municipal_tax_certification) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('municipal_tax_certification', $serviceProvider->fiscalCertification?->municipal_tax_certification) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('municipal_tax_certification', $serviceProvider->fiscalCertification?->municipal_tax_certification) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('municipal_tax_certification')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="cnd_federal_debt" class="form-label">CND - Certidão Negativa
                                                de Débitos Relativos aos Tributos Federais e à Dívida Ativa da
                                                União</label>
                                            <select name="cnd_federal_debt" id="cnd_federal_debt"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('cnd_federal_debt', $serviceProvider->fiscalCertification?->cnd_federal_debt) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('cnd_federal_debt', $serviceProvider->fiscalCertification?->cnd_federal_debt) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('cnd_federal_debt', $serviceProvider->fiscalCertification?->cnd_federal_debt) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('cnd_federal_debt')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    @can('isAdmin')
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button class="btn btn-light me-2">Cancelar</button>
                                            <button class="btn btn-primary">Salvar</button>
                                        </div>
                                    @endcan

                                    @can('isClient')
                                        <a href="{{ route('service-provider.show', $serviceProvider->id) }}"
                                            class="btn btn-primary">Voltar</a>
                                    @endcan
                                </form>

                            </div>

                            {{-- NOTE: Habilitação Econômica --}}
                            <div id="economica" class="container tab-pane fade">
                                <h1>Habilitação Econômica</h1>
                                <form method="POST"
                                    action="{{ route('indicator.updateOrCreateEconomicCertification') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
                                            <select @can('isClient') disabled @endcan name="service_provider_id"
                                                id="service_provider_id" class="form-select border border-2 p-2"
                                                required readonly>
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
                                                @can('isClient') disabled @endcan
                                                value="{{ old('contract_start_end', optional(\Carbon\Carbon::parse($serviceProvider->economicCertification?->contract_start_end))->format('Y-m-d')) }}"
                                                class="form-control border border-2 p-2" required>

                                            @error('contract_start_end')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="company_size" class="form-label">Porte</label>
                                            <input type="text" name="company_size" id="company_size"
                                                @can('isClient') disabled @endcan
                                                value="{{ old('company_size', $serviceProvider->economicCertification?->company_size) }}"
                                                class="form-control border border-2 p-2" required>
                                            @error('company_size')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="calculation_memory" class="form-label">Memória de
                                                Cálculo</label>
                                            <select @can('isClient') disabled @endcan name="calculation_memory"
                                                id="calculation_memory" class="form-select border border-2 p-2"
                                                required>
                                                <option value="Conforme"
                                                    {{ old('calculation_memory', $serviceProvider->economicCertification?->calculation_memory) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('calculation_memory', $serviceProvider->economicCertification?->calculation_memory) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('calculation_memory', $serviceProvider->economicCertification?->calculation_memory) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('calculation_memory')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="bankruptcy_certificate" class="form-label">Certidão Negativa
                                                de Falência e Protesto</label>
                                            <select @can('isClient') disabled @endcan name="bankruptcy_certificate"
                                                id="bankruptcy_certificate" class="form-select border border-2 p-2"
                                                required>
                                                <option value="Conforme"
                                                    {{ old('bankruptcy_certificate', $serviceProvider->economicCertification?->bankruptcy_certificate) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('bankruptcy_certificate', $serviceProvider->economicCertification?->bankruptcy_certificate) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('bankruptcy_certificate', $serviceProvider->economicCertification?->bankruptcy_certificate) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('bankruptcy_certificate')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="dre_balance_sheet" class="form-label">DRE/Balancete</label>
                                            <select @can('isClient') disabled @endcan name="dre_balance_sheet"
                                                id="dre_balance_sheet" class="form-select border border-2 p-2"
                                                required>
                                                <option value="Conforme"
                                                    {{ old('dre_balance_sheet', $serviceProvider->economicCertification?->dre_balance_sheet) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('dre_balance_sheet', $serviceProvider->economicCertification?->dre_balance_sheet) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('dre_balance_sheet', $serviceProvider->economicCertification?->dre_balance_sheet) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('dre_balance_sheet')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="issues_invoice" class="form-label">Emite Nota Fiscal?</label>
                                            <select @can('isClient') disabled @endcan name="issues_invoice"
                                                id="issues_invoice" class="form-select border border-2 p-2" required>
                                                <option value="Conforme"
                                                    {{ old('issues_invoice', $serviceProvider->economicCertification?->issues_invoice) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('issues_invoice', $serviceProvider->economicCertification?->issues_invoice) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('issues_invoice', $serviceProvider->economicCertification?->issues_invoice) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                            </select>
                                            @error('issues_invoice')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    @can('isAdmin')
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button class="btn btn-light me-2">Cancelar</button>
                                            <button class="btn btn-primary">Salvar</button>
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
            </div>
        </div>
    </main>

</x-layout>
