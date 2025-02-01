<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="client-store"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="service-provider"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="col-md-12 mb-lg-0 mb-4">
            <div class="mt-4">
                <div class=" pb-0 p-3">
                    <div class="row">
                        <div class="col-12 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('service-provider.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Novo Prestador</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Prestadores</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nome</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                CNPJ</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Ações</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $client->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $client->cnpj }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-{{ $client->status === 'Ativo' ? 'success' : 'danger' }}">
                                                        {{ $client->status }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('client.edit', $client->id) }}"
                                                        {{-- Link para editar --}}
                                                        class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-secondary text-white"
                                                        data-toggle="tooltip" data-original-title="Editar usuário">
                                                        Editar
                                                    </a>
                                                    {{-- NOTE: AQUI VAI SER UMA ROTA QUE VAI DESATIVAR --}}
{{--
                                                    <form action="{{ route('client.destroy', $client->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-danger text-white"
                                                            data-toggle="tooltip"
                                                            data-original-title="Desativar usuário">
                                                            Desativar
                                                        </button>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <x-footers.auth></x-footers.auth> --}}
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
