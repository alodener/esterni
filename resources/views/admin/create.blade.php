<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="Administrador"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Novo Administrador'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-5 mb-5">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Novo Administrador</h6>
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
                        <form method="POST" action="{{ route('admin.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nome *</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control border border-2 p-2" value="{{ old('name') }}" required>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="sobrenome" class="form-label">Sobrenome *</label>
                                    <input type="text" name="sobrenome" id="sobrenome"
                                        class="form-control border border-2 p-2" value="{{ old('sobrenome') }}" required>
                                    @error('sobrenome')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="email"class="form-label">Email *</label>
                                    <input type="email" class="form-control border border-2 p-2" name="email"
                                        value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror

                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Senha *</label>
                                    <input type="password" class="form-control border border-2 p-2" name="password"
                                        id="password" required>
                                    @error('password')
                                        <p class="text-danger inputerror">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirmar Senha *</label>
                                    <input type="password" class="form-control border border-2 p-2"
                                        name="password_confirmation" id="password_confirmation" required>
                                </div>

                            </div>

                            <div class="mt-3 d-flex justify-content-end">
                                <a href="{{ route('admin.index') }}" class="btn btn-primary">Cancelar</a>
                                <button type="submit" class="btn btn-primary" style="margin-left: 15px">Salvar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-layout>
