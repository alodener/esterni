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
                                        <div class="mb-3 col-md-6">
                                            <label for="payroll_entries_correct" class="form-label">Os lançamentos realizados na folha/férias/rescisão estão corretos?</label>
                                            <select name="payroll_entries_correct" id="payroll_entries_correct" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('payroll_entries_correct')}}></option>
                                                <option value="Conforme"
                                                    {{ old('payroll_entries_correct')}}>Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('payroll_entries_correct')}}>Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('payroll_entries_correct')}}>Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('payroll_entries_correct')}}>Não se aplica</option>
                                            </select>
                                            @error('payroll_entries_correct')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="payroll_compliance" class="form-label">Folha/Férias/Rescisões foram pagas em conformidade?</label>
                                            <select name="payroll_compliance" id="payroll_compliance" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('payroll_compliance')}}></option>
                                                <option value="Conforme"
                                                    {{ old('payroll_compliance')}}>Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('payroll_compliance')}}>Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('payroll_compliance')}}>Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('payroll_compliance')}}>Não se aplica</option>
                                            </select>
                                            @error('payroll_compliance')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="benefits_paid_correctly" class="form-label">Os benefícios foram pagos corretamente?</label>
                                            <select name="benefits_paid_correctly" id="benefits_paid_correctly" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('benefits_paid_correctly')}}></option>
                                                <option value="Conforme"
                                                    {{ old('benefits_paid_correctly')}}>Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('benefits_paid_correctly')}}>Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('benefits_paid_correctly')}}>Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('benefits_paid_correctly')}}>Não se aplica</option>
                                            </select>
                                            @error('benefits_paid_correctly')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label for="leave_records_correct" class="form-label">Os afastamentos foram feitos corretamente?</label>
                                            <select name="leave_records_correct" id="leave_records_correct" @can('isClient') disabled @endcan
                                                class="form-select border border-2 p-2">
                                                <option value=""
                                                    {{ old('leave_records_correct')}}></option>
                                                <option value="Conforme"
                                                    {{ old('leave_records_correct')}}>Conforme</option>
                                                <option value="Não Conforme"
                                                    {{ old('leave_records_correct')}}>Não Conforme</option>
                                                <option value="Conforme Parcialmente"
                                                    {{ old('leave_records_correct')}}>Conforme Parcialmente</option>
                                                <option value="Não se aplica"
                                                    {{ old('leave_records_correct')}}>Não se aplica</option>
                                            </select>
                                            @error('leave_records_correct')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror
                                        </div>
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
    @endpush
</x-layout>
