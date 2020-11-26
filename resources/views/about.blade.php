@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <div class="text-center">
                                <h5 class="font-weight-bold">MarcosKlender</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://github.com/marcosklender" target="_blank" class="btn btn-github btn-circle btn-lg"><i class="fab fa-github fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://marcosklender.brizy.site" target="_blank" class="btn btn-primary btn-circle btn-lg"><i class="fas fa-link fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://twitter.com/marcosklender" target="_blank" class="btn btn-twitter btn-circle btn-lg"><i class="fab fa-twitter fa-fw"></i></a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">[Español] Laravel 8.6.0 + SB Admin 2</h5>
                            </div>
                            <br><p>Recomiento utilizar estos archivos para un proyecto completamente nuevo. <br>De lo contrario, lo más probable es que tu proyecto deje de funcionar correctamente.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p>Laravel SB Admin 2 usa librerías/paquetes de terceros, por lo que se agradece a toda la comunidad Open Source.</p>
                            <ul>
                                <li><a href="https://laravel.com" target="_blank">Laravel</a> - Framework open-source de PHP.</li>
                                <li><a href="https://github.com/DevMarketer/LaravelEasyNav" target="_blank">LaravelEasyNav</a> - Hace que la navegación en Laravel sea más fácil.</li>
                                <li><a href="https://startbootstrap.com/themes/sb-admin-2" target="_blank">SB Admin 2</a> - Gracias a Start Bootstrap.</li>
                            </ul>
                            <div class="text-center mt-4">
                                <a href="https://github.com/marcosklender/laravel-sb-admin-2" target="_blank" class="btn btn-github">
                                    <i class="fab fa-github fa-fw"></i> Ir al Repositorio
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
