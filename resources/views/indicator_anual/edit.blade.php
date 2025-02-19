<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Indicador Mensal - Editar"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-0">
            <div class="card card-body mx-md-4 mt-4">
                <div class="card card-plain h-400 mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center">
                                <h6 class="mb-0">Indicador Mensal - Editar</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row container">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-fill mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#folha_13">Folha 13º</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#ferias">Férias</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#saude_seguranca_trabalho">Saúde e
                                    Segurança no Trabalho </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#ccc_act_fgts">CCT/ACT e FGTS</a>
                            </li>
                        </ul>

                        <!-- Form Unificado -->
                        <form method="POST" action="{{ route('auditCompliance.auditCompliance') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="number" name="id" value="{{ $auditCompliance->id }}" style="display: none">

                            <!-- Modal -->
                            <div class="modal fade show" id="monthYearModal" tabindex="-1"
                                aria-labelledby="monthYearModalLabel" aria-hidden="true" data-bs-backdrop="static"
                                data-bs-keyboard="false">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="monthYearModalLabel">Selecione o Mês e
                                                Ano</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Ano</label>
                                                <select id="year" name="year" class="form-select" readonly style=" pointer-events: none; background-color: #e9ecef;"></select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="confirmSelection" class="btn btn-primary" type="button"
                                                disabled>Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <!-- SECTION: Folha 13º -->
                                <div id="folha_13" class="container tab-pane active">
                                    <h1>Folha 13º</h1>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_provider_id" class="form-label">Prestador de Serviço</label>
                                            <select name="service_provider_id" id="service_provider_id"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2"
                                                required readonly>
                                                <option selected="selected" value="{{ $serviceProvider->id }}" readonly>
                                                    {{ $serviceProvider->company_name }}
                                                </option>
                                            </select>
                                            @error('service_provider_id')
                                                <p class='text-danger'>{ $message }</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="payroll_thirteenth_launches" class="form-label">Os lançamentos foram
                                                efetuados e pagos corretamente?</label>
                                            <select name="payroll_thirteenth_launches" id="payroll_thirteenth_launches"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->payroll_thirteenth_launches == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_launches == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_launches == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->payroll_thirteenth_launches == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->payroll_thirteenth_launches == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('payroll_thirteenth_launches')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="payroll_thirteenth_fgts" class="form-label">Conformidade nos
                                                lançamentos e pagamento do FGTS</label>
                                            <select name="payroll_thirteenth_fgts" id="payroll_thirteenth_fgts"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->payroll_thirteenth_fgts == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_fgts == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_fgts == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->payroll_thirteenth_fgts == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->payroll_thirteenth_fgts == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('payroll_thirteenth_fgts')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="payroll_thirteenth_inss" class="form-label">Conformidade nos
                                                lançamentos e pagamento do INSS</label>
                                            <select name="payroll_thirteenth_inss" id="payroll_thirteenth_inss"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->payroll_thirteenth_inss == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_inss == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_inss == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->payroll_thirteenth_inss == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->payroll_thirteenth_inss == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('payroll_thirteenth_inss')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="payroll_thirteenth_ir" class="form-label">Conformidade nos
                                                lançamentos e pagamento do IR</label>
                                            <select name="payroll_thirteenth_ir" id="payroll_thirteenth_ir"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->payroll_thirteenth_ir == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_ir == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->payroll_thirteenth_ir == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->payroll_thirteenth_ir == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->payroll_thirteenth_ir == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('payroll_thirteenth_ir')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <!-- SECTION: Férias -->
                                <div id="ferias" class="container tab-pane fade">
                                    <h1>Férias</h1>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="vacation_granted_on_time" class="form-label">As férias foram
                                                concedidas dentro do prazo legal?</label>
                                            <select name="vacation_granted_on_time" id="vacation_granted_on_time"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->vacation_granted_on_time == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->vacation_granted_on_time == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->vacation_granted_on_time == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->vacation_granted_on_time == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->vacation_granted_on_time == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('vacation_granted_on_time')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="vacation_paid_on_time" class="form-label">As férias foram pagas
                                                dentro do prazo legal?</label>
                                            <select name="vacation_paid_on_time" id="vacation_paid_on_time"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->vacation_paid_on_time == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->vacation_paid_on_time == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->vacation_paid_on_time == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->vacation_paid_on_time == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->vacation_paid_on_time == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('vacation_paid_on_time')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="vacation_planning" class="form-label">Existe planejamento de
                                                férias?</label>
                                            <select name="vacation_planning" id="vacation_planning"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->vacation_planning == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->vacation_planning == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->vacation_planning == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->vacation_planning == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->vacation_planning == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('vacation_planning')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="vacation_documentation" class="form-label">A documentação de
                                                férias foi elaborada e assinada?</label>
                                            <select name="vacation_documentation" id="vacation_documentation"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->vacation_documentation == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->vacation_documentation == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->vacation_documentation == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->vacation_documentation == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->vacation_documentation == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('vacation_documentation')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <!-- SECTION: Saúde e Segurança no Trabalho -->
                                <div id="saude_seguranca_trabalho" class="container tab-pane fade">
                                    <h1>Saúde e Segurança no Trabalho</h1>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="occupational_exams" class="form-label">Exames periódicos
                                                realizados?</label>
                                            <select name="occupational_exams" id="occupational_exams"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->occupational_exams == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->occupational_exams == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->occupational_exams == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->occupational_exams == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->occupational_exams == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('occupational_exams')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="occupational_programs" class="form-label">Programas Ocupacionais
                                                vigentes?</label>
                                            <select name="occupational_programs" id="occupational_programs"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->occupational_programs == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->occupational_programs == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->occupational_programs == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->occupational_programs == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->occupational_programs == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('occupational_programs')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="occupational_trainings" class="form-label">Treinamentos
                                                ocupacionais realizados?</label>
                                            <select name="occupational_trainings" id="occupational_trainings"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->occupational_trainings == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->occupational_trainings == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->occupational_trainings == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->occupational_trainings == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->occupational_trainings == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('occupational_trainings')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="esocial_events" class="form-label">Eventos do eSocial enviados em
                                                conformidade?</label>
                                            <select name="esocial_events" id="esocial_events"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->esocial_events == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->esocial_events == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->esocial_events == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->esocial_events == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->esocial_events == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('esocial_events')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- SECTION: CCT/ACT e FGTS -->
                                <div id="ccc_act_fgts" class="container tab-pane fade">
                                    <h1>CCT/ACT e FGTS</h1>
                                    <div class="row">

                                        <div class="mb-3 col-md-6">
                                            <label for="salary_cct_act" class="form-label">Salário pago com base na
                                                CCT/ACT?</label>
                                            <select name="salary_cct_act" id="salary_cct_act"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->salary_cct_act == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->salary_cct_act == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->salary_cct_act == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->salary_cct_act == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->salary_cct_act == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('salary_cct_act')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="special_work_shifts_cct_act" class="form-label">Jornadas de
                                                trabalho especiais realizadas conforme CCT/ACT?</label>
                                            <select name="special_work_shifts_cct_act" id="special_work_shifts_cct_act"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->special_work_shifts_cct_act == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->special_work_shifts_cct_act == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->special_work_shifts_cct_act == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->special_work_shifts_cct_act == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->special_work_shifts_cct_act == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('special_work_shifts_cct_act')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="benefits_cct_act" class="form-label">Pagamento dos benefícios e
                                                adicionais conforme CCT/ACT?</label>
                                            <select name="benefits_cct_act" id="benefits_cct_act"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->benefits_cct_act == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->benefits_cct_act == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->benefits_cct_act == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->benefits_cct_act == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->benefits_cct_act == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('benefits_cct_act')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="fgts_balance_deposited" class="form-label">Saldo de FGTS
                                                depositado corretamente?</label>
                                            <select name="fgts_balance_deposited" id="fgts_balance_deposited"
                                                @can('isClient') disabled @endcan class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ $auditCompliance->fgts_balance_deposited == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ $auditCompliance->fgts_balance_deposited == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ $auditCompliance->fgts_balance_deposited == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ $auditCompliance->fgts_balance_deposited == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ $auditCompliance->fgts_balance_deposited == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('fgts_balance_deposited')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
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
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Obtém a hash da URL
                let hash = window.location.hash;

                if (hash) {
                    let tab = document.querySelector(`a[href="${hash}"]`);
                    if (tab) {
                        new bootstrap.Tab(tab).show();
                    }
                }

                // Atualiza a URL ao trocar de aba (opcional)
                document.querySelectorAll('.nav-link').forEach(tab => {
                    tab.addEventListener('click', function() {
                        history.pushState(null, null, this.getAttribute('href;
                    });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Força a abertura do modal ao carregar a página
                var modal = new bootstrap.Modal(document.getElementById('monthYearModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                modal.show();

                // Recuperando valores antigos do Laravel
                let oldYear = "{{ $auditCompliance->year }}";
                let yearSelect = document.getElementById("year");
                let currentYear = new Date().getFullYear();

                for (let i = currentYear + 1; i >= currentYear - 10; i--) {
                    let option = document.createElement("option");
                    option.value = i;
                    option.textContent = i;

                    // Aplica o valor antigo do Laravel se existir
                    if (oldYear == i) {
                        option.selected = true;
                    }

                    yearSelect.appendChild(option);
                }

                // Desabilitar botão até que mês e ano sejam selecionados
                let confirmButton = document.getElementById("confirmSelection");

                function validateSelection() {
                    confirmButton.disabled = !(yearSelect.value);
                }

                yearSelect.addEventListener("change", validateSelection);

                // Habilita o botão caso os valores antigos já estejam preenchidos
                validateSelection();

                // Fechar modal apenas quando o usuário confirmar a seleção
                confirmButton.addEventListener("click", function() {
                    modal.hide();
                });
            });
        </script>
    @endpush
</x-layout>
