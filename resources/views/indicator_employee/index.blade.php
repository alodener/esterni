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

                            {{-- NOTE: Documentação
                                    Contratual dos Empregados --}}
                            <div id="contratual" class="container tab-pane active">
                                <h1>Documentação
                                    Contratual dos Empregados</h1>
                                <form method="POST" action="{{ route('indicatorEmployee.employeeContractualDocs') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                @can('isClient') disabled @endcan
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
                                            <label for="professional_council_certificate" class="form-label">Certidão
                                                de
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

                            {{-- NOTE: Saúde e Segurança
                                    Ocupacional --}}
                            <div id="ocupacionais" class="container tab-pane fade">
                                <h1>Saúde e Segurança
                                    Ocupacional</h1>
                                <form method="POST" action="{{ route('indicatorEmployee.occupationalProgram') }}"
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
                                                    {{ $serviceProvider->company_name }}
                                                </option>
                                            </select>
                                            @error('service_provider_id')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="ltcat" class="form-label">LTCAT</label>
                                            <select name="ltcat" id="ltcat" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('ltcat', $serviceProvider->occupationalPrograms?->ltcat) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('ltcat', $serviceProvider->occupationalPrograms?->ltcat) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('ltcat', $serviceProvider->occupationalPrograms?->ltcat) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('ltcat', $serviceProvider->occupationalPrograms?->ltcat) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('ltcat')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="pgr" class="form-label">PGR</label>
                                            <select name="pgr" id="pgr" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('pgr', $serviceProvider->occupationalPrograms?->pgr) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('pgr', $serviceProvider->occupationalPrograms?->pgr) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('pgr', $serviceProvider->occupationalPrograms?->pgr) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('pgr', $serviceProvider->occupationalPrograms?->pgr) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('pgr')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="pcmso" class="form-label">PCMSO</label>
                                            <select name="pcmso" id="pcmso" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('pcmso', $serviceProvider->occupationalPrograms?->pcmso) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('pcmso', $serviceProvider->occupationalPrograms?->pcmso) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('pcmso', $serviceProvider->occupationalPrograms?->pcmso) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('pcmso', $serviceProvider->occupationalPrograms?->pcmso) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('pcmso')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="insalubrity_report" class="form-label">Laudo de
                                                Insalubridade</label>
                                            <select name="insalubrity_report" id="insalubrity_report"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('insalubrity_report', $serviceProvider->occupationalPrograms?->insalubrity_report) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('insalubrity_report', $serviceProvider->occupationalPrograms?->insalubrity_report) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('insalubrity_report', $serviceProvider->occupationalPrograms?->insalubrity_report) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('insalubrity_report', $serviceProvider->occupationalPrograms?->insalubrity_report) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('insalubrity_report')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="danger_report" class="form-label">Laudo de
                                                Periculosidade</label>
                                            <select name="danger_report" id="danger_report"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('danger_report', $serviceProvider->occupationalPrograms?->danger_report) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('danger_report', $serviceProvider->occupationalPrograms?->danger_report) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('danger_report', $serviceProvider->occupationalPrograms?->danger_report) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('danger_report', $serviceProvider->occupationalPrograms?->danger_report) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('danger_report')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="aet" class="form-label">AET</label>
                                            <select name="aet" id="aet" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('aet', $serviceProvider->occupationalPrograms?->aet) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('aet', $serviceProvider->occupationalPrograms?->aet) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('aet', $serviceProvider->occupationalPrograms?->aet) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('aet', $serviceProvider->occupationalPrograms?->aet) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('aet')
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

                            {{-- NOTE: Saúde e Segurança
                                    Ocupacional --}}
                            <div id="segurança_ocupacional" class="container tab-pane fade">
                                <h1>Saúde e Segurança
                                    Ocupacional</h1>
                                <form method="POST"
                                    action="{{ route('indicatorEmployee.occupationalHealthSafety') }}"
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
                                                    {{ $serviceProvider->company_name }}
                                                </option>
                                            </select>
                                            @error('service_provider_id')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="aso" class="form-label">ASO</label>
                                            <select name="aso" id="aso" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('aso', $serviceProvider->occupationalHealthSafety?->aso) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('aso', $serviceProvider->occupationalHealthSafety?->aso) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('aso', $serviceProvider->occupationalHealthSafety?->aso) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('aso', $serviceProvider->occupationalHealthSafety?->aso) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('aso')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="complementary_exams" class="form-label">Exames
                                                Complementares</label>
                                            <select name="complementary_exams" id="complementary_exams"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('complementary_exams', $serviceProvider->occupationalHealthSafety?->complementary_exams) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('complementary_exams', $serviceProvider->occupationalHealthSafety?->complementary_exams) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('complementary_exams', $serviceProvider->occupationalHealthSafety?->complementary_exams) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('complementary_exams', $serviceProvider->occupationalHealthSafety?->complementary_exams) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('complementary_exams')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="work_order" class="form-label">Ordem de Serviço</label>
                                            <select name="work_order" id="work_order"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('work_order', $serviceProvider->occupationalHealthSafety?->work_order) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('work_order', $serviceProvider->occupationalHealthSafety?->work_order) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('work_order', $serviceProvider->occupationalHealthSafety?->work_order) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('work_order', $serviceProvider->occupationalHealthSafety?->work_order) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('work_order')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="epi_uniform_record" class="form-label">Ficha de
                                                EPI/Fardamento</label>
                                            <select name="epi_uniform_record" id="epi_uniform_record"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('epi_uniform_record', $serviceProvider->occupationalHealthSafety?->epi_uniform_record) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('epi_uniform_record', $serviceProvider->occupationalHealthSafety?->epi_uniform_record) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('epi_uniform_record', $serviceProvider->occupationalHealthSafety?->epi_uniform_record) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('epi_uniform_record', $serviceProvider->occupationalHealthSafety?->epi_uniform_record) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('epi_uniform_record')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="esocial_events_submission" class="form-label">Envio dos
                                                eventos do eSocial (S-2220, S-2240, S-2210, S-2221)</label>
                                            <select name="esocial_events_submission" id="esocial_events_submission"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('esocial_events_submission', $serviceProvider->occupationalHealthSafety?->esocial_events_submission) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('esocial_events_submission', $serviceProvider->occupationalHealthSafety?->esocial_events_submission) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('esocial_events_submission', $serviceProvider->occupationalHealthSafety?->esocial_events_submission) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('esocial_events_submission', $serviceProvider->occupationalHealthSafety?->esocial_events_submission) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('esocial_events_submission')
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

                            {{-- NOTE: Treinamentos
                                    Ocupacionais --}}
                            <div id="treinamentos_ocupacionais" class="container tab-pane fade">
                                <h1>Treinamentos
                                    Ocupacionais</h1>
                                <form method="POST" action="{{ route('indicatorEmployee.occupationalTraining') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de
                                                Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                @can('isClient') disabled @endcan
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
                                            <label for="nr_01_general_safety" class="form-label">NR 01 - Orientações
                                                de segurança em Geral</label>
                                            <select name="nr_01_general_safety" id="nr_01_general_safety"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_01_general_safety', $serviceProvider->occupationalTrainings?->nr_01_general_safety) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_01_general_safety', $serviceProvider->occupationalTrainings?->nr_01_general_safety) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_01_general_safety', $serviceProvider->occupationalTrainings?->nr_01_general_safety) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_01_general_safety', $serviceProvider->occupationalTrainings?->nr_01_general_safety) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_01_general_safety')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_04_epi" class="form-label">NR 04 - EPI</label>
                                            <select name="nr_04_epi" id="nr_04_epi" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_04_epi', $serviceProvider->occupationalTrainings?->nr_04_epi) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_04_epi', $serviceProvider->occupationalTrainings?->nr_04_epi) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_04_epi', $serviceProvider->occupationalTrainings?->nr_04_epi) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_04_epi', $serviceProvider->occupationalTrainings?->nr_04_epi) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_04_epi')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_18_construction" class="form-label">NR 18 - Construção
                                                Civil</label>
                                            <select name="nr_18_construction" id="nr_18_construction"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_18_construction', $serviceProvider->occupationalTrainings?->nr_18_construction) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_18_construction', $serviceProvider->occupationalTrainings?->nr_18_construction) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_18_construction', $serviceProvider->occupationalTrainings?->nr_18_construction) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_18_construction', $serviceProvider->occupationalTrainings?->nr_18_construction) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_18_construction')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_35_work_at_height" class="form-label">NR 35 - Trabalho em
                                                Altura</label>
                                            <select name="nr_35_work_at_height" id="nr_35_work_at_height"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_35_work_at_height', $serviceProvider->occupationalTrainings?->nr_35_work_at_height) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_35_work_at_height', $serviceProvider->occupationalTrainings?->nr_35_work_at_height) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_35_work_at_height', $serviceProvider->occupationalTrainings?->nr_35_work_at_height) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_35_work_at_height', $serviceProvider->occupationalTrainings?->nr_35_work_at_height) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_35_work_at_height')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_10_electricity" class="form-label">NR 10 -
                                                Eletricidade</label>
                                            <select name="nr_10_electricity" id="nr_10_electricity"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_10_electricity', $serviceProvider->occupationalTrainings?->nr_10_electricity) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_10_electricity', $serviceProvider->occupationalTrainings?->nr_10_electricity) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_10_electricity', $serviceProvider->occupationalTrainings?->nr_10_electricity) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_10_electricity', $serviceProvider->occupationalTrainings?->nr_10_electricity) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_10_electricity')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_11_transport_handling" class="form-label">NR 11 -
                                                Transporte, Movimentação, Armazenagem e Manuseio de equipamentos</label>
                                            <select name="nr_11_transport_handling" id="nr_11_transport_handling"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_11_transport_handling', $serviceProvider->occupationalTrainings?->nr_11_transport_handling) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_11_transport_handling', $serviceProvider->occupationalTrainings?->nr_11_transport_handling) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_11_transport_handling', $serviceProvider->occupationalTrainings?->nr_11_transport_handling) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_11_transport_handling', $serviceProvider->occupationalTrainings?->nr_11_transport_handling) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_11_transport_handling')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_14_furnaces" class="form-label">NR 14 - Fornos</label>
                                            <select name="nr_14_furnaces" id="nr_14_furnaces"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_14_furnaces', $serviceProvider->occupationalTrainings?->nr_14_furnaces) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_14_furnaces', $serviceProvider->occupationalTrainings?->nr_14_furnaces) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_14_furnaces', $serviceProvider->occupationalTrainings?->nr_14_furnaces) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_14_furnaces', $serviceProvider->occupationalTrainings?->nr_14_furnaces) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_14_furnaces')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_17_ergonomics" class="form-label">NR 17 - Ergonomia</label>
                                            <select name="nr_17_ergonomics" id="nr_17_ergonomics"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_17_ergonomics', $serviceProvider->occupationalTrainings?->nr_17_ergonomics) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_17_ergonomics', $serviceProvider->occupationalTrainings?->nr_17_ergonomics) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_17_ergonomics', $serviceProvider->occupationalTrainings?->nr_17_ergonomics) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_17_ergonomics', $serviceProvider->occupationalTrainings?->nr_17_ergonomics) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_17_ergonomics')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="nr_19_explosives" class="form-label">NR 19 -
                                                Explosivos</label>
                                            <select name="nr_19_explosives" id="nr_19_explosives"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value="Conforme"
                                                    {{ old('nr_19_explosives', $serviceProvider->occupationalTrainings?->nr_19_explosives) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('nr_19_explosives', $serviceProvider->occupationalTrainings?->nr_19_explosives) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('nr_19_explosives', $serviceProvider->occupationalTrainings?->nr_19_explosives) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('nr_19_explosives', $serviceProvider->occupationalTrainings?->nr_19_explosives) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>
                                            </select>
                                            @error('nr_19_explosives')
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
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>
