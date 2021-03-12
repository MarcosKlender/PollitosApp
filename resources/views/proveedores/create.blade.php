@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>NUEVO PROVEEDOR</h4>
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
                    <form method="post" action="{{ route('proveedores.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="tipo">Tipo de Identificación</label>
                            <select class="custom-select" id="tipo" name="tipo" required>
                                <option value="" selected disabled>Elija una opción</option>
                                <option value="RUC">RUC</option>
                                <option value="CI">CI</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cantidad">Número de Identificación</label>
                            <input type="text" class="form-control" id="ruc_ci" name="ruc_ci" value="{{ old('ruc_ci') }}"
                                maxlength="13" required />
                        </div>

                        <div class="form-group">
                            <label for="procedencia">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres"
                                value="{{ old('nombres') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Razón Social</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social"
                                value="{{ old('razon_social') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                value="{{ old('direccion') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                value="{{ old('telefono') }}" maxlength="9" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Móvil</label>
                            <input type="text" class="form-control" id="movil" name="movil" value="{{ old('movil') }}"
                                maxlength="10" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia"
                                value="{{ old('provincia') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Parroquia</label>
                            <input type="text" class="form-control" id="parroquia" name="parroquia"
                                value="{{ old('parroquia') }}" required />
                        </div>

                        <div class="row justify-content-around">
                            <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Cancelar</a>
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
            $('#nombres').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#razon_social').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#direccion').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#provincia').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#ciudad').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#parroquia').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });

    </script>

@endsection
