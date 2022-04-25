<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2 en Español">
    <meta name="author" content="MarcosKlender">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon mt-3">
                    <img src="/img/pollovencedor.png" width="70" height="70">
                </div>
                <div class="sidebar-brand-text mx-3">Pollitos App</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Admin') }}
            </div>

            @if (Auth::user()->rol->key == 'admin')
                <!-- Nav Item - Usuarios -->
                <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>{{ __('Usuarios') }}</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->rol->key == 'admin' OR Auth::user()->rol->key == 'ingresos' OR Auth::user()->rol->key == 'egresos' OR Auth::user()->rol->key == 'entregas' OR Auth::user()->rol->key == 'egre_entr')
                <!-- Nav Item - Profile -->
                <li class="nav-item {{ request()->is('configuracion') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('configuracion.index') }}">
                        <i class="fas fa-code"></i>
                        <span>{{ __('Configuracion') }}</span></a>
                </li>
            @endif

            @if (Auth::user()->rol->key == 'admin')
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Básculas') }}
                </div>

                <!-- Nav configuracion bascula - Admin -->
                <li class="nav-item {{ request()->is('basculaconfiguracion') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('basculaconfiguracion.index') }}">
                        <i class="fas fa-weight"></i>
                        <span>{{ __('Configurar') }}</span>
                    </a>
                </li>

                <!-- Nav Item - Admin -->
                <li class="nav-item {{ request()->is('basculas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('basculas.index') }}">
                        <i class="fas fa-weight"></i>
                        <span>{{ __('Asignar') }}</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">
            @endif
            
            @if (Auth::user()->rol->key == 'ingresos' OR Auth::user()->rol->key == 'egresos' OR Auth::user()->rol->key == 'admin' OR Auth::user()->rol->key == 'egre_entr')
                <!-- Nav Item - Admin -->
                <li class="nav-item {{ request()->is('proveedores') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('proveedores.index') }}">
                        <i class="fas fa-fw fa-warehouse"></i>
                        <span>{{ __('Proveedores') }}</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->rol->key == 'entregas' OR Auth::user()->rol->key == 'admin' OR Auth::user()->rol->key == 'egre_entr')
                <!-- Nav Item - Admin -->
                <li class="nav-item {{ request()->is('clientes') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('clientes.index') }}">
                        <i class="fas fa-fw fa-address-card"></i>
                        <span>{{ __('Clientes') }}</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Registros') }}
            </div>

            @if (Auth::user()->rol->key == 'ingresos' OR Auth::user()->rol->key == 'admin')
                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ request()->is('pesobruto') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pesobruto.index') }}">
                        <i class="fas fa-arrow-circle-right"></i>
                        <span>{{ __('Ingresos') }}</span></a>
                </li>

                <!--li class="nav-item {{ request()->is('visceras') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('visceras.index') }}">
                        <i class="fas fa-drumstick-bite"></i>
                        <span>{{ __('Vísceras y Buches') }}</span></a>
                </li!-->
            @endif

            @if (Auth::user()->rol->key == 'egresos' OR Auth::user()->rol->key == 'admin' OR Auth::user()->rol->key == 'egre_entr')
                <li class="nav-item {{ request()->is('egresos') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('egresos.index') }}">
                        <i class="fas fa-arrow-circle-left"></i>
                        <span>{{ __('Egresos') }}</span></a>
                </li>
            @endif

            @if (Auth::user()->rol->key == 'entregas' OR Auth::user()->rol->key == 'admin' OR Auth::user()->rol->key == 'egre_entr')
                <li class="nav-item {{ request()->is('entregas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('entregas.index') }}">
                        <i class="fas fa-fw fa-truck"></i>
                        <span>{{ __('Entregas') }}</span></a>
                </li>
            @endif

            @if (Auth::user()->rol->key == 'admin')
                <li class="nav-item {{ request()->is('liquidados') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('liquidados.index') }}">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ __('Liquidados') }}</span></a>
                </li>
            @endif

            @if (Auth::user()->rol->key == 'egresos' OR Auth::user()->rol->key == 'entregas' OR Auth::user()->rol->key == 'admin' OR Auth::user()->rol->key == 'egre_entr')
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Reportería') }}
                </div>

                <li class="nav-item {{ request()->is('reportes') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reportes.index') }}">
                        <i class="fas fa-fw fa-copy"></i>
                        <span>{{ __('Lotes') }}</span></a>
                </li>

                <li class="nav-item {{ request()->is('reportesentregas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reportesentregas.index') }}">
                        <i class="fas fa-fw fa-copy"></i>
                        <span>{{ __('Entregas') }}</span></a>
                </li>
            @endif

            <!-- Nav Item - Profile -->
            <!--li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('profile') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Perfil') }}</span>
                </a>
            </li!-->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small mr-4">{{ Auth::user()->fullName }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Perfil') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Cerrar Sesión') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('¿Está seguro?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Por favor, confirme si está listo para cerrar sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">{{ __('Cancelar') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Cerrar Sesión') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Footer -->
    <footer class="sticky-footer bg-white ">
        <div class="container">
            <div class="copyright text-center mx-auto">
                <span>Copyright &copy; <a href="https://ilinser.com/" target="_blank">iLinser</a> 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</body>

</html>
