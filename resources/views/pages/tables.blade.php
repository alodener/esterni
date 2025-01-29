<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="col-md-12 mb-lg-0 mb-4">
            <div class=" mt-4">
                <div class=" pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            {{-- <h6 class="mb-0">Payment Method</h6> --}}
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Novo Cliente</a>
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
                                <h6 class="text-white text-capitalize ps-3">Clientes</h6>
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
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">John Michael</h6>
                                                        <p class="text-xs text-secondary mb-0">john@creative-tim.com
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">47128868000135</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="javascript:;"
                                                    class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-secondary text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Editar
                                                </a>
                                                <a href="javascript:;"
                                                    class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-danger text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Desativar
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            alexa@creative-tim.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">06275373000151</p>
                                                {{-- <p class="text-xs text-secondary mb-0">Developer</p> --}}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="javascript:;"
                                                    class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-secondary text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Editar
                                                </a>
                                                <a href="javascript:;"
                                                    class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-danger text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Desativar
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            laurent@creative-tim.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">86844209000157</p>
                                                {{-- <p class="text-xs text-secondary mb-0">Projects</p> --}}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </td>
                                            {{-- <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">19/09/17</span>
                                                </td> --}}
                                            <td class="align-middle text-center">
                                                <a href="javascript:;"
                                                    class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-secondary text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Editar
                                                </a>
                                                <a href="javascript:;"
                                                    class="text-secondary font-weight-bold text-xs badge badge-sm bg-gradient-danger text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Desativar
                                                </a>
                                            </td>
                                        </tr>
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
