<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Editar Prestador'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-5 mb-5">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Editar Prestador</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        {{-- NOTE: PELO QUE ENTENDI SERVE COMO ALERTA --}}
                        @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('demo'))
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('demo') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        {{-- FORMULARIO CRIAR PRESTADOR --}}
                        <form method="POST" action="{{ route('service-provider.update', $serviceProvider->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="company_name" class="form-label">Nome da Empresa</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control border border-2 p-2" value="{{ old('company_name', $serviceProvider->company_name) }}" required>
                                    @error('company_name')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="provider_cnpj" class="form-label">CNPJ</label>
                                    <input type="text" name="provider_cnpj" id="provider_cnpj" class="form-control border border-2 p-2" value="{{ old('provider_cnpj', $serviceProvider->provider_cnpj) }}" required>
                                    @error('provider_cnpj')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="social_purpose" class="form-label">Objeto Social</label>
                                    <input type="text" name="social_purpose" id="social_purpose" class="form-control border border-2 p-2" value="{{ old('social_purpose', $serviceProvider->social_purpose) }}">
                                    @error('social_purpose')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="company_type" class="form-label">Tipo de Empresa</label>
                                    <input type="text" name="company_type" id="company_type" class="form-control border border-2 p-2" value="{{ old('company_type', $serviceProvider->company_type) }}">
                                    @error('company_type')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="company_opening_date" class="form-label">Data de Abertura</label>
                                    <input type="date" name="company_opening_date" id="company_opening_date" class="form-control border border-2 p-2" value="{{ old('company_opening_date', $serviceProvider->company_opening_date) }}">
                                    @error('company_opening_date')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="share_capital" class="form-label">Capital Social</label>
                                    <input type="number" name="share_capital" id="share_capital" class="form-control border border-2 p-2" value="{{ old('share_capital', $serviceProvider->share_capital) }}">
                                    @error('share_capital')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="mb-3 col-md-6">
                                        <label for="managing_partner_{{ $i }}" class="form-label">Sócio Administrador {{ $i }}</label>
                                        <input type="text" name="managing_partner_{{ $i }}" id="managing_partner_{{ $i }}" class="form-control border border-2 p-2" value="{{ old('managing_partner_' . $i, $serviceProvider->{'managing_partner_' . $i} ?? '') }}">
                                        @error('managing_partner_'. $i)<p class='text-danger'>{{ $message }}</p>@enderror
                                    </div>
                                @endfor

                                <div class="mb-3 col-md-6">
                                    <label for="risk_level" class="form-label">Nível de Risco</label>
                                    <input type="text" name="risk_level" id="risk_level" class="form-control border border-2 p-2" value="{{ old('risk_level', $serviceProvider->risk_level) }}">
                                    @error('risk_level')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="service_provided" class="form-label">Serviço Prestado</label>
                                    <input type="text" name="service_provided" id="service_provided" class="form-control border border-2 p-2" value="{{ old('service_provided', $serviceProvider->service_provided) }}">
                                    @error('service_provided')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="relationship_contact" class="form-label">Contato</label>
                                    <input type="text" name="relationship_contact" id="relationship_contact" class="form-control border border-2 p-2" value="{{ old('relationship_contact', $serviceProvider->relationship_contact) }}">
                                    @error('relationship_contact')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="contract_start_date" class="form-label">Início do Contrato</label>
                                    <input type="date" name="contract_start_date" id="contract_start_date" class="form-control border border-2 p-2" value="{{ old('contract_start_date', $serviceProvider->contract_start_date) }}">
                                    @error('contract_start_date')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="contract_end_date" class="form-label">Término do Contrato</label>
                                    <input type="date" name="contract_end_date" id="contract_end_date" class="form-control border border-2 p-2" value="{{ old('contract_end_date', $serviceProvider->contract_end_date) }}">
                                    @error('contract_end_date')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="monthly_base_value" class="form-label">Valor Base Mensal</label>
                                    <input type="number" name="monthly_base_value" id="monthly_base_value" class="form-control border border-2 p-2" value="{{ old('monthly_base_value', $serviceProvider->monthly_base_value) }}">
                                    @error('monthly_base_value')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="retention_clause" class="form-label">Cláusula de Retenção</label>
                                    <input type="text" name="retention_clause" id="retention_clause" class="form-control border border-2 p-2" value="{{ old('retention_clause', $serviceProvider->retention_clause) }}">
                                    @error('retention_clause')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="number_of_contracted_employees" class="form-label">Número de Funcionários</label>
                                    <input type="number" name="number_of_contracted_employees" id="number_of_contracted_employees" class="form-control border border-2 p-2" value="{{ old('number_of_contracted_employees', $serviceProvider->number_of_contracted_employees) }}">
                                    @error('number_of_contracted_employees')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="client_id" class="form-label">Vínculo</label>
                                    <select name="client_id" id="client_id" class="form-select border border-2 p-2" required>
                                        <option value="">Selecione um cliente</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('client_id', $serviceProvider->client_id) == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-plugins></x-plugins>

</x-layout>
