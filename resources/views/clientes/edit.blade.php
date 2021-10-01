@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR CLIENTE</h4>
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
                    <form method="post" action="{{ route('clientes.update', $cliente->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select class="custom-select" id="tipo" name="tipo" required>
                                <option value="" selected disabled>Elije un tipo</option>
                                <option value="RUC">RUC</option>
                                <option value="CI">CI</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ruc_ci">RUC/CI</label>
                            <input type="text" class="form-control" id="ruc_ci" name="ruc_ci" value="{{ $cliente->ruc_ci }}"
                                maxlength="13" required />
                        </div>

                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres"
                                value="{{ $cliente->nombres }}" required />
                        </div>

                        <div class="form-group">
                            <label for="razon_social">Razón Social</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social"
                                value="{{ $cliente->razon_social }}" />
                        </div>

                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                value="{{ $cliente->direccion }}" />
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                value="{{ $cliente->telefono }}" maxlength="10" />
                        </div>

                        <div class="form-group">
                            <label for="movil">Móvil</label>
                            <input type="text" class="form-control" id="movil" name="movil" value="{{ $cliente->movil }}"
                                maxlength="10" />
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $cliente->email }}" />
                        </div>

                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia"
                                value="{{ $cliente->provincia }}" />
                        </div>

                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad"
                                value="{{ $cliente->ciudad }}" />
                        </div>

                        <div class="form-group">
                            <label for="parroquia">Parroquia</label>
                            <input type="text" class="form-control" id="parroquia" name="parroquia"
                                value="{{ $cliente->parroquia }}" />
                        </div>

                        <div class="row justify-content-around">
                            <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
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
            $("#tipo").val("{{ $cliente->tipo }}");

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
