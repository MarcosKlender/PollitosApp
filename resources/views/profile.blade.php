@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ Auth::user()->name[0] }}{{ Auth::user()->last_name[0] }}"></figure>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{  Auth::user()->fullName }}</h5>
                                <h6 class="font-weight-bold">{{  Auth::user()->ci }}</h6>
                                <p>{{ Auth::user()->rol->name }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mi Cuenta</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Información de Usuario</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nombres<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Nombres" value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Apellidos</label><span class="small text-danger">*</span></label>
                                        <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Apellidos" value="{{ old('last_name', Auth::user()->last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Correo Electrónico<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="ejemplo@ejemplo.com" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="heading-small text-muted mt-2 mb-4">Cambio de Contraseña</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Contraseña Actual</label>
                                        <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Contraseña Actual">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Nueva Contraseña</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Nueva Contraseña">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="password_confirmation">Confirmar Contraseña</label>
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="text-danger mt-2 mb-4"><strong>* Para editar sólo la "Información de Usuario", deja en blanco el "Cambio de Contraseña"</strong></h6>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
