<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="client"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-5 mb-5">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Cadastrar Cliente</h6>
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
                        <form method="POST" action="{{ route('client.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control border border-2 p-2" value="{{ old('name') }}" required>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="cnpj" class="form-label">CNPJ</label>
                                    <input type="text" name="cnpj" id="cnpj"
                                        class="form-control border border-2 p-2" value="{{ old('cnpj') }}" required>
                                    @error('cnpj')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="street" class="form-label">Rua</label>
                                    <input type="text" name="street" id="street"
                                        class="form-control border border-2 p-2" value="{{ old('street') }}" required>
                                    @error('street')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="number" class="form-label">Número</label>
                                    <input type="text" name="number" id="number"
                                        class="form-control border border-2 p-2" value="{{ old('number') }}"
                                        required>
                                    @error('number')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="complement" class="form-label">Complemento</label>
                                    <input type="text" name="complement" id="complement"
                                        class="form-control border border-2 p-2" value="{{ old('complement') }}">
                                    @error('complement')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="district" class="form-label">Bairro</label>
                                    <input type="text" name="district" id="district"
                                        class="form-control border border-2 p-2" value="{{ old('district') }}"
                                        required>
                                    @error('district')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">Cidade</label>
                                    <input type="text" name="city" id="city"
                                        class="form-control border border-2 p-2" value="{{ old('city') }}"
                                        required>
                                    @error('city')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">Estado</label>
                                    <input type="text" name="state" id="state"
                                        class="form-control border border-2 p-2" value="{{ old('state') }}"
                                        required>
                                    @error('state')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zip_code" class="form-label">CEP</label>
                                    <input type="text" name="zip_code" id="zip_code"
                                        class="form-control border border-2 p-2" value="{{ old('zip_code') }}"
                                        required>
                                    @error('zip_code')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="country" class="form-label">País</label>
                                    <input type="text" name="country" id="country"
                                        class="form-control border border-2 p-2" value="{{ old('country') }}"
                                        required>
                                    @error('country')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Senha</label>
                                    <input type="password" class="form-control border border-2 p-2" name="password"
                                        id="password" required>
                                    @error('password')
                                        <p class="text-danger inputerror">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                    <input type="password" class="form-control border border-2 p-2"
                                        name="password_confirmation" id="password_confirmation" required>
                                </div>

                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Enviar</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-plugins></x-plugins>

</x-layout>
