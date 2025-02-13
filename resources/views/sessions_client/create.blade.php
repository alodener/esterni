<x-layout bodyClass="">
    <main class="main-content" style="margin-top: 100px">
        <div class="page-header align-items-start min-vh-100">
            <div class="container">
                <div class="row signin-margin">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="">
                            <div class="">
                                <center>
                                    <img src="{{ asset('assets') }}/img/esterni/logo.png" style="width: 70%" />
                                </center>
                                <form role="form" method="POST" action="{{ route('client.signin') }}" class="text-start mt-4">
                                    @csrf
                                    @if (Session::has('status'))
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                                            <span class="text-sm">{{ Session::get('status') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="input-group input-group-outline mt-3">
                                        <label class="form-label">Usuario</label>
                                        <input type="text" class="form-control" name="cnpj">
                                    </div>
                                    @error('cnpj')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="input-group input-group-outline mt-3">
                                        <label class="form-label">Senha</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary my-4 mb-2">
                                            Entrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <x-footers.guest></x-footers.guest> --}}
        </div>
    </main>
    @push('js')
        <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
        <script>
            $(function() {

                var text_val = $(".input-group input").val();
                if (text_val === "") {
                    $(".input-group").removeClass('is-filled');
                } else {
                    $(".input-group").addClass('is-filled');
                }
            });
        </script>
    @endpush
</x-layout>
