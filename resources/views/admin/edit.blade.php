@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>Editar Usuario</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('admin.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="active">Usuario Activo</label>
                            <select class="custom-select" id="active" name="active" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rol_id">Permisos</label>
                            <select class="custom-select" id="rol_id" name="rol_id" required>
                                <option value="1">Administrador</option>
                                <option value="2">Ingresos</option>
                                <option value="3">Egresos</option>
                                <option value="4">Entregas</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <input type="name" class="form-control" id="username" name="username" value="{{ $user->username }}" required />
                        </div> --}}
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input type="name" class="form-control" id="name" name="name" value="{{ $user->name }}"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellidos</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ $user->last_name }}" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                                required />
                        </div>
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="check_password" name="check_password">
                            <label class="custom-control-label" for="check_password">¿Cambiar Contraseña?</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="password" name="password" disabled />
                        </div>
                        <div class="row justify-content-around">
                            <a href="{{ route('admin.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#active").val("{{ $user->active }}");
            $("#rol_id").val("{{ $user->rol_id }}");

            $("#check_password").click(function() {
                if ($("#password").prop("disabled") === true) {
                    $("#password").prop("disabled", false);
                } else {
                    $("#password").val("");
                    $("#password").prop("disabled", true);
                }
            });
        });

    </script>

@endsection
