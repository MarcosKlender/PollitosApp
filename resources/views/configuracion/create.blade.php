@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>NUEVA CONFIGURACION</h4>
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
                    <form method="post" action="{{ route('configuracion.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="valor">Módulo</label>
                            <select class="custom-select" id="mod_conf" name="mod_conf" required>
                                <option value="" selected disabled>Elije un módulo</option>
                                <option value="INGRESOS">INGRESOS</option>
                                <option value="EGRESOS">EGRESOS</option>
                                <option value="ENTREGAS">ENTREGAS</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="des_conf" name="des_conf"
                                value="{{ old('des_conf') }}" required row="3" /> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="automatico">Autómatico</label>
                            <input type="text" class="form-control" id="aut_conf" name="aut_conf"
                                value="{{ old('aut_conf') }}" required/>
                        </div>

                        <div class="form-group">
                            <label for="valor">Elemento</label>
                            <input type="text" class="form-control" id="ele_conf" name="ele_conf"
                                value="{{ old('ele_conf') }}" required />
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="val_conf" name="val_conf"
                                value="{{ old('val_conf') }}" required />
                        </div>

                            <div class="form-group">
                            <label for="valor">Estado</label>
                            <select class="custom-select" id="est_conf" name="est_conf" required>
                                <option value="" selected disabled>Elije un estado </option>
                                <option value="0">ACTIVO</option>
                                <option value="1">INACTIVO</option>
                            </select>
                        </div>
                        <div class="row justify-content-around">
                            <a href="{{ route('configuracion.index') }}" class="btn btn-danger">Cancelar</a>
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

            $('#des_conf').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#ele_conf').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });


        });

    </script>

@endsection
