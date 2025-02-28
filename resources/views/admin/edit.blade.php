<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="Administrador"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Editar Administrador'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-5 mb-5">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Editar Administrador</h6>
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

                        {{-- FORMULARIO CRIAR USUARIO --}}
                        <form method="POST" action="{{ route('admin.update', $user->id) }}">
                            @csrf
                            @method('PUT') {{-- Importante: Adicione o método PUT para a atualização --}}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nome *</label>
                                    <input type="text" name="name" id="name" class="form-control border border-2 p-2" value="{{ old('name', explode(' ', $user->name)[0]) ?? '' }}" required>
                                    @error('name')<p class='text-danger inputerror'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="sobrenome" class="form-label">Sobrenome *</label>
                                    <input type="text" name="sobrenome" id="sobrenome" class="form-control border border-2 p-2" value="{{ old('name', explode(' ', $user->name)[1] ?? '' ) }}" required>
                                    @error('name')<p class='text-danger inputerror'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="text" name="email" id="email" class="form-control border border-2 p-2" value="{{ old('email', $user->email) }}" required>
                                    @error('name')<p class='text-danger inputerror'>{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Nova Senha (deixe em branco para manter a senha atual) *</label>
                                    <input type="password" class="form-control border border-2 p-2" name="password" id="password">
                                    @error('password')
                                    <p class="text-danger inputerror">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirmar Nova Senha *</label>
                                    <input type="password" class="form-control border border-2 p-2" name="password_confirmation" id="password_confirmation">
                                </div>

                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Atualizar</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>


</x-layout>
