@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>Crear Nuevo Usuario</h4>
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
                    <form method="post" action="{{ route('admin.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="active">Usuario Activo</label>
                            <select class="custom-select" id="active" name="active" required>
                                <option value="" selected disabled>Elije un estado</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rol_id">Permisos</label>
                            <select class="custom-select" id="rol_id" name="rol_id" required>
                                <option value="" selected disabled>Elije un rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Ingresos</option>
                                <option value="3">Egresos</option>
                                <option value="4">Entregas</option>
                                <option value="5">Egresos y Entregas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ old('username') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellidos</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ old('last_name') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label><i class="fas fa-eye" id="togglePassword"
                                style="padding-left: 3%; cursor: pointer;"></i>
                            <input type="password" class="form-control" id="password" name="password" required />
                        </div>
                        <div class="row justify-content-around">
                            <a href="{{ route('admin.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#username').keyup(function() {
                $(this).val($(this).val().toLowerCase());
            });

            $('#name').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#last_name').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#email').keyup(function() {
                $(this).val($(this).val().toLowerCase());
            });

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                this.classList.toggle('fa-eye-slash');
            });
        });

    </script>

@endsection
