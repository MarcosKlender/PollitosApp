@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR CONFIGURACION</h4>
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
                    <form method="post" action="{{ route('configuracion.update', $configuracion->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="valor">Módulo</label>
                            <select class="custom-select" id="mod_conf" name="mod_conf" required>
                                <option value="INGRESOS">INGRESOS</option>
                                <option value="EGRESOS">EGRESOS</option>
                                <option value="ENTREGAS">ENTREGAS</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="des_conf">Descripción</label>
                            <textarea class="form-control" id="des_conf" name="des_conf"
                                required rows="3" />{{ $configuracion->des_conf }} </textarea>
                        </div>

                        <div class="form-group">
                            <label for="ele_conf">Elemento</label>
                            <input type="text" class="form-control" id="ele_conf" name="ele_conf"
                                value="{{ $configuracion->ele_conf }}" required />
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="val_conf" name="val_conf"
                                value="{{ $configuracion->val_conf }}" required />
                        </div>
                        
                        <div class="form-group">
                            <label for="valor">Estado</label>
                            <select class="custom-select" id="est_conf" name="est_conf" required>
                                <option value="0">ACTIVO</option>
                                <option value="1">INACTIVO</option>
                            </select>
                        </div>

                        <div class="row justify-content-around">
                            <a href="{{ route('configuracion.index') }}" class="btn btn-danger">Cancelar</a>
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

            $("#mod_conf").val("{{ $configuracion->mod_conf }}");
            $("#est_conf").val("{{ $configuracion->est_conf }}");

            $('#des_conf').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#ele_conf').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });


        });

    </script>

@endsection
