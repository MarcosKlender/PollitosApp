@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR PROVEEDOR</h4>
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
                    <form method="post" action="{{ route('proveedores.update', $proveedor->id) }}">
                        @csrf
                        @method('PATCH')
                        <!--div class="form-group">
                            <label for="tipo">Tipo de Identificación</label>
                            <select class="custom-select" id="tipo" name="tipo" required>
                                <option value="" selected disabled>Elija una opción</option>
                                <option value="RUC">RUC</option>
                                <option value="CI">CI</option>
                            </select>
                        </div!-->

                        <div class="form-group">
                            <label for="cantidad">Número de Identificación</label>
                            <input type="text" class="form-control" id="pro_ruc" name="pro_ruc"
                                value="{{ $proveedor->pro_ruc }}" maxlength="13" required />
                        </div>

                        <div class="form-group">
                            <label for="procedencia">Nombres</label>
                            <input type="text" class="form-control" id="pro_nombre" name="pro_nombre"
                                value="{{ $proveedor->pro_nombre }}" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Razón Social</label>
                            <input type="text" class="form-control" id="pro_nombre_comercial" name="pro_nombre_comercial"
                                value="{{ $proveedor->pro_nombre_comercial }}" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Dirección</label>
                            <input type="text" class="form-control" id="pro_direccion" name="pro_direccion"
                                value="{{ $proveedor->pro_direccion }}" required />
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Teléfono</label>
                            <input type="text" class="form-control" id="pro_telefonos" name="pro_telefonos"
                                value="{{ $proveedor->pro_telefonos }}" maxlength="10" required />
                        </div>

                        <div class="form-group">
                            <label for="procedencia">Correo Electrónico</label>
                            <input type="email" class="form-control" id="pro_email" name="pro_email"
                                value="{{ $proveedor->pro_email }}" required />
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
            //$("#tipo").val("{{ $proveedor->tipo }}");

            $('#pro_nombre').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#pro_nombre_comercial').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#pro_direccion').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

        });

    </script>

@endsection
