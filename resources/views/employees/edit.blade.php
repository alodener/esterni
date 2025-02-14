<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="service-provider"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Editar Funcionário'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-5 mb-5">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Editar Funcionário</h6>
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

                        {{-- FORMULARIO EDITAR FUNCIONARIO --}}
                        <form method="POST" action="{{ route('employees.update', [$employee->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="service_provider_id" class="form-label">Prestador de Serviço</label>
                                    <select name="service_provider_id" id="service_provider_id"
                                        class="form-select border border-2 p-2" required readonly @can('isClient') disabled @endcan>
                                        <option selected="selected" value="{{ $serviceProvider->id }}" readonly>
                                            {{ $serviceProvider->company_name }}</option>
                                    </select>
                                    @error('service_provider_id')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="photo" class="form-label">Foto</label>
                                    <input type="file" name="photo" id="photo"
                                        class="form-control border border-2 p-2"@can('isClient') disabled @endcan>
                                    @error('photo')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="system_enable_date" class="form-label">Data de Habilitação no
                                        Sistema</label>
                                    <input type="date" name="system_enable_date" id="system_enable_date"
                                    @can('isClient') disabled @endcan value="{{ old('system_enable_date', $employee->system_enable_date ? $employee->system_enable_date->format('Y-m-d') : '') }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('system_enable_date')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="client_name" class="form-label">Nome do Cliente</label>
                                    <input type="text" name="client_name" id="client_name"
                                    @can('isClient') disabled @endcan
                                        value="{{ old('client_name', $employee->client_name) }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('client_name')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="provider_name" class="form-label">Nome do Prestador</label>
                                    <input type="text" name="provider_name" id="provider_name"
                                    @can('isClient') disabled @endcan
                                        class="form-control border border-2 p-2"
                                        value="{{ old('provider_name', $employee->provider_name) }}"
                                        readonly required>
                                    @error('provider_name')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="provider_cnpj" class="form-label">CNPJ do Prestador</label>
                                    <input type="text" name="provider_cnpj" id="provider_cnpj"
                                    @can('isClient') disabled @endcan
                                        class="form-control border border-2 p-2"
                                        value="{{ old('client_name', $employee->provider_cnpj) }}"
                                         readonly required>
                                    @error('provider_cnpj')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="employee_name" class="form-label">Nome do Funcionário</label>
                                    <input type="text" name="employee_name" id="employee_name"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('employee_name', $employee->employee_name) }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('employee_name')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="admission_date" class="form-label">Data de Admissão</label>
                                    <input type="date" name="admission_date" id="admission_date"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('admission_date', $employee->admission_date ? $employee->admission_date->format('Y-m-d') : '') }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('admission_date')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="dismissal_date" class="form-label">Data de Demissão</label>
                                    <input type="date" name="dismissal_date" id="dismissal_date"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('dismissal_date', $employee->dismissal_date ? $employee->dismissal_date->format('Y-m-d') : '') }}"
                                        class="form-control border border-2 p-2">
                                    @error('dismissal_date')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="job_title" class="form-label">Cargo</label>
                                    <input type="text" name="job_title" id="job_title"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('job_title', $employee->job_title) }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('job_title')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="salary" class="form-label">Salário</label>
                                    <input type="number" step="0.01" name="salary" id="salary"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('salary', $employee->salary) }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('salary')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="insalubrity" class="form-label">Insalubridade</label>
                                    <select @can('isClient') disabled @endcan name="insalubrity" id="insalubrity" class="form-select border border-2 p-2" required>
                                        <option value="0" {{ $employee->insalubrity == 0 ? 'selected' : '' }}>Não</option>
                                        <option value="1" {{ $employee->insalubrity == 1 ? 'selected' : '' }}>Sim</option>
                                    </select>
                                    @error('insalubrity')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="dangerousness" class="form-label">Periculosidade</label>
                                    <select @can('isClient') disabled @endcan name="dangerousness" id="dangerousness" class="form-select border border-2 p-2" required>
                                        <option value="0" {{ $employee->dangerousness == 0 ? 'selected' : '' }}>Não</option>
                                        <option value="1" {{ $employee->dangerousness == 1 ? 'selected' : '' }}>Sim</option>
                                    </select>
                                    @error('dangerousness')<p class='text-danger'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="work_schedule" class="form-label">Horário de Trabalho</label>
                                    <input type="text" name="work_schedule" id="work_schedule"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('work_schedule', $employee->work_schedule) }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('work_schedule')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="department" class="form-label">Departamento</label>
                                    <input type="text" name="department" id="department"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('department', $employee->department) }}"
                                        class="form-control border border-2 p-2" required>
                                    @error('department')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="start_client_allocation" class="form-label">Ínicio da Lotação no
                                        Tomador</label>
                                    <input type="date" name="start_client_allocation" id="start_client_allocation"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('start_client_allocation', $employee->start_client_allocation ? $employee->start_client_allocation->format('Y-m-d') : '') }}"
                                        class="form-control border border-2 p-2">
                                    @error('start_client_allocation')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="end_client_allocation" class="form-label">Fim da Lotação no
                                        Tomador</label>
                                    <input type="date" name="end_client_allocation" id="end_client_allocation"
                                    @can('isClient') disabled @endcan
                                    value="{{ old('end_client_allocation', $employee->end_client_allocation ? $employee->end_client_allocation->format('Y-m-d') : '') }}"
                                        class="form-control border border-2 p-2">
                                    @error('end_client_allocation')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @can('isAdmin') <button type="submit" class="btn btn-primary">Atualizar</button> @endcan
                            @can('isClient') <a href="{{ route('employees.show', $serviceProvider->id) }}" class="btn btn-primary">Voltar</a> @endcan

                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-plugins></x-plugins>

</x-layout>
