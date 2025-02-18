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
                                                <label for="month" class="form-label">Mês</label>
                                                <select id="month" name="month" class="form-select">
                                                    <option value="">Selecione um mês</option>
                                                    <option value="1" {{ old('month') == 1 ? 'selected' : '' }}>
                                                        Janeiro</option>
                                                    <option value="2" {{ old('month') == 2 ? 'selected' : '' }}>
                                                        Fevereiro</option>
                                                    <option value="3" {{ old('month') == 3 ? 'selected' : '' }}>
                                                        Março</option>
                                                    <option value="4" {{ old('month') == 4 ? 'selected' : '' }}>
                                                        Abril</option>
                                                    <option value="5" {{ old('month') == 5 ? 'selected' : '' }}>
                                                        Maio</option>
                                                    <option value="6" {{ old('month') == 6 ? 'selected' : '' }}>
                                                        Junho</option>
                                                    <option value="7" {{ old('month') == 7 ? 'selected' : '' }}>
                                                        Julho</option>
                                                    <option value="8" {{ old('month') == 8 ? 'selected' : '' }}>
                                                        Agosto</option>
                                                    <option value="9" {{ old('month') == 9 ? 'selected' : '' }}>
                                                        Setembro</option>
                                                    <option value="10" {{ old('month') == 10 ? 'selected' : '' }}>
                                                        Outubro</option>
                                                    <option value="11" {{ old('month') == 11 ? 'selected' : '' }}>
                                                        Novembro</option>
                                                    <option value="12" {{ old('month') == 12 ? 'selected' : '' }}>
                                                        Dezembro</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Ano</label>
                                                <select id="year" name="year" class="form-select"></select>
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

                                <!-- NOTE: Folha de Pagamento -->
                                <div id="folha_pagamento" class="container tab-pane active">
                                    <h1>Folha de Pagamento</h1>
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
                                            <label for="payroll_entries_correct" class="form-label">Os lançamentos
                                                realizados na folha/férias/rescisão estão corretos?</label>
                                            <select name="payroll_entries_correct" id="payroll_entries_correct"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('payroll_entries_correct', session('valid_data.payroll_entries_correct')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção
                                                </option>
                                                <option value="Conforme"
                                                    {{ old('payroll_entries_correct', session('valid_data.payroll_entries_correct')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme
                                                </option>
                                                <option value="Não Conforme"
                                                    {{ old('payroll_entries_correct', session('valid_data.payroll_entries_correct')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme
                                                </option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('payroll_entries_correct', session('valid_data.payroll_entries_correct')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente
                                                </option>
                                                <option value="Não se aplica"
                                                    {{ old('payroll_entries_correct', session('valid_data.payroll_entries_correct')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica
                                                </option>
                                            </select>
                                            @error('payroll_entries_correct')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-3 col-md-6">
                                            <label for="payroll_compliance" class="form-label">Folha/Férias/Rescisões
                                                foram pagas em conformidade?</label>
                                            <select name="payroll_compliance" id="payroll_compliance"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('payroll_compliance', session('valid_data.payroll_compliance')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('payroll_compliance', session('valid_data.payroll_compliance')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('payroll_compliance', session('valid_data.payroll_compliance')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('payroll_compliance', session('valid_data.payroll_compliance')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('payroll_compliance', session('valid_data.payroll_compliance')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('payroll_compliance')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="benefits_paid_correctly" class="form-label">Os benefícios
                                                foram pagos corretamente?</label>
                                            <select name="benefits_paid_correctly" id="benefits_paid_correctly"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('benefits_paid_correctly', session('valid_data.benefits_paid_correctly')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('benefits_paid_correctly', session('valid_data.benefits_paid_correctly')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('benefits_paid_correctly', session('valid_data.benefits_paid_correctly')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('benefits_paid_correctly', session('valid_data.benefits_paid_correctly')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('benefits_paid_correctly', session('valid_data.benefits_paid_correctly')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('benefits_paid_correctly')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="leave_records_correct" class="form-label">Os afastamentos
                                                foram feitos corretamente?</label>
                                            <select name="leave_records_correct" id="leave_records_correct"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('leave_records_correct', session('valid_data.leave_records_correct')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('leave_records_correct', session('valid_data.leave_records_correct')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('leave_records_correct', session('valid_data.leave_records_correct')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('leave_records_correct', session('valid_data.leave_records_correct')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('leave_records_correct', session('valid_data.leave_records_correct')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('leave_records_correct')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <!-- NOTE: Jornada de Trabalho -->
                                <div id="jornada_trabalho" class="container tab-pane fade">
                                    <h1>Jornada de Trabalho</h1>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="work_schedules_presented" class="form-label">Espelhos de Ponto
                                                Apresentados</label>
                                            <select name="work_schedules_presented" id="work_schedules_presented"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('work_schedules_presented', session('valid_data.work_schedules_presented')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('work_schedules_presented', session('valid_data.work_schedules_presented')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('work_schedules_presented', session('valid_data.work_schedules_presented')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('work_schedules_presented', session('valid_data.work_schedules_presented')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('work_schedules_presented', session('valid_data.work_schedules_presented')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('work_schedules_presented')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="work_records_compliant" class="form-label">Registros
                                                realizados em conformidade</label>
                                            <select name="work_records_compliant" id="work_records_compliant"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('work_records_compliant', session('valid_data.work_records_compliant')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('work_records_compliant', session('valid_data.work_records_compliant')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('work_records_compliant', session('valid_data.work_records_compliant')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('work_records_compliant', session('valid_data.work_records_compliant')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('work_records_compliant', session('valid_data.work_records_compliant')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('work_records_compliant')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="overtime_compliant" class="form-label">Horas extras realizadas
                                                em conformidade com a CLT</label>
                                            <select name="overtime_compliant" id="overtime_compliant"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('overtime_compliant', session('valid_data.overtime_compliant')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('overtime_compliant', session('valid_data.overtime_compliant')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('overtime_compliant', session('valid_data.overtime_compliant')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('overtime_compliant', session('valid_data.overtime_compliant')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('overtime_compliant', session('valid_data.overtime_compliant')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('overtime_compliant')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="rest_periods_complied" class="form-label">Cumprimento
                                                intrajornada e interjornada</label>
                                            <select name="rest_periods_complied" id="rest_periods_complied"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('rest_periods_complied', session('valid_data.rest_periods_complied')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('rest_periods_complied', session('valid_data.rest_periods_complied')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('rest_periods_complied', session('valid_data.rest_periods_complied')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('rest_periods_complied', session('valid_data.rest_periods_complied')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('rest_periods_complied', session('valid_data.rest_periods_complied')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('rest_periods_complied')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- NOTE: Encargos Trabalhistas -->
                                <div id="encargo_trabalhista" class="container tab-pane fade">
                                    <h1>Encargos Trabalhistas</h1>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="tax_guides_presented" class="form-label">Guias e
                                                detalhamentos/relatórios apresentados (FGTS/INSS/IR)?</label>
                                            <select name="tax_guides_presented" id="tax_guides_presented"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('tax_guides_presented', session('valid_data.tax_guides_presented')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('tax_guides_presented', session('valid_data.tax_guides_presented')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('tax_guides_presented', session('valid_data.tax_guides_presented')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('tax_guides_presented', session('valid_data.tax_guides_presented')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('tax_guides_presented', session('valid_data.tax_guides_presented')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('tax_guides_presented')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="fgts_compliance" class="form-label">Conformidade nos
                                                lançamentos e pagamento do FGTS</label>
                                            <select name="fgts_compliance" id="fgts_compliance"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('fgts_compliance', session('valid_data.fgts_compliance')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('fgts_compliance', session('valid_data.fgts_compliance')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('fgts_compliance', session('valid_data.fgts_compliance')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('fgts_compliance', session('valid_data.fgts_compliance')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('fgts_compliance', session('valid_data.fgts_compliance')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('fgts_compliance')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="inss_compliance" class="form-label">Conformidade nos
                                                lançamentos e pagamento do INSS</label>
                                            <select name="inss_compliance" id="inss_compliance"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('inss_compliance', session('valid_data.inss_compliance')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('inss_compliance', session('valid_data.inss_compliance')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('inss_compliance', session('valid_data.inss_compliance')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('inss_compliance', session('valid_data.inss_compliance')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('inss_compliance', session('valid_data.inss_compliance')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('inss_compliance')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="ir_compliance" class="form-label">Conformidade nos lançamentos
                                                e pagamento do IR</label>
                                            <select name="ir_compliance" id="ir_compliance"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('ir_compliance', session('valid_data.ir_compliance')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('ir_compliance', session('valid_data.ir_compliance')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('ir_compliance', session('valid_data.ir_compliance')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('ir_compliance', session('valid_data.ir_compliance')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('ir_compliance', session('valid_data.ir_compliance')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('ir_compliance')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- NOTE: Saúde e Segurança no Trabalho -->
                                <div id="saude_seguranca_trabalho" class="container tab-pane fade">
                                    <h1>Saúde e Segurança no Trabalho</h1>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="cat_submitted_on_time" class="form-label">CAT emitida e
                                                enviada ao eSocial dentro do prazo legal</label>
                                            <select name="cat_submitted_on_time" id="cat_submitted_on_time"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('cat_submitted_on_time', session('valid_data.cat_submitted_on_time')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('cat_submitted_on_time', session('valid_data.cat_submitted_on_time')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('cat_submitted_on_time', session('valid_data.cat_submitted_on_time')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('cat_submitted_on_time', session('valid_data.cat_submitted_on_time')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('cat_submitted_on_time', session('valid_data.cat_submitted_on_time')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('cat_submitted_on_time')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="cipa_training" class="form-label">CIPA/treinamentos</label>
                                            <select name="cipa_training" id="cipa_training"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('cipa_training', session('valid_data.cipa_training')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('cipa_training', session('valid_data.cipa_training')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('cipa_training', session('valid_data.cipa_training')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('cipa_training', session('valid_data.cipa_training')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('cipa_training', session('valid_data.cipa_training')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('cipa_training')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="medical_certificates_presented" class="form-label">Atestados
                                                apresentados (doença relacionada às atividades laborais)</label>
                                            <select name="medical_certificates_presented"
                                                id="medical_certificates_presented" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('medical_certificates_presented', session('valid_data.medical_certificates_presented')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('medical_certificates_presented', session('valid_data.medical_certificates_presented')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('medical_certificates_presented', session('valid_data.medical_certificates_presented')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('medical_certificates_presented', session('valid_data.medical_certificates_presented')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('medical_certificates_presented', session('valid_data.medical_certificates_presented')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('medical_certificates_presented')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="accident_investigation_presented"
                                                class="form-label">Investigação de Acidente - apresentado</label>
                                            <select name="accident_investigation_presented"
                                                id="accident_investigation_presented"
                                                @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('accident_investigation_presented', session('valid_data.accident_investigation_presented')) == '' ? 'selected' : '' }}>
                                                    Selecione uma opção</option>

                                                <option value="Conforme"
                                                    {{ old('accident_investigation_presented', session('valid_data.accident_investigation_presented')) == 'Conforme' ? 'selected' : '' }}>
                                                    Conforme</option>

                                                <option value="Não Conforme"
                                                    {{ old('accident_investigation_presented', session('valid_data.accident_investigation_presented')) == 'Não Conforme' ? 'selected' : '' }}>
                                                    Não Conforme</option>

                                                <option value="Conforme Parcialmente"
                                                    {{ old('accident_investigation_presented', session('valid_data.accident_investigation_presented')) == 'Conforme Parcialmente' ? 'selected' : '' }}>
                                                    Conforme Parcialmente</option>

                                                <option value="Não se aplica"
                                                    {{ old('accident_investigation_presented', session('valid_data.accident_investigation_presented')) == 'Não se aplica' ? 'selected' : '' }}>
                                                    Não se aplica</option>

                                            </select>
                                            @error('accident_investigation_presented')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
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
                        history.pushState(null, null, this.getAttribute('href'));
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
                let oldMonth = "{{ old('month') }}";
                let oldYear = "{{ old('year') }}";

                // Preenchendo o campo de ano dinamicamente (últimos 10 anos até o próximo ano)
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

                // Selecionando o mês salvo anteriormente
                let monthSelect = document.getElementById("month");
                if (oldMonth) {
                    monthSelect.value = oldMonth;
                }

                // Desabilitar botão até que mês e ano sejam selecionados
                let confirmButton = document.getElementById("confirmSelection");

                function validateSelection() {
                    confirmButton.disabled = !(monthSelect.value && yearSelect.value);
                }

                monthSelect.addEventListener("change", validateSelection);
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
