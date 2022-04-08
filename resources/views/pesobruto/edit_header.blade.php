@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR REGISTRO - PESO EN BRUTO</h4>
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
                    
                    <form method="post" action="{{ route('pesobruto.update_header') }}">
                        @csrf

                        <div class="form-group">
                            <label for="tipo">Tipo de Animal</label>
                            <input type="text" class="form-control" id="tipo" name="tipo"
                                    value="{{ $lote->tipo }}" required readonly/>
                        </div>
    
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad"
                                    value="{{ $lote->cantidad }}" required />
                        </div>
    
                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <input type="text" class="form-control" id="proveedor" name="proveedor"
                                    value="{{ $lote->proveedor }}" required readonly/>
                        </div>
    
                        <div class="form-group">
                            <label for="procedencia">Procedencia</label>
                            <input type="text" class="form-control" id="procedencia" name="procedencia"
                                    value="{{ $lote->procedencia }}" required />
                        </div>

                        <div class="form-group">
                            <label for="placa">Placa del Vehículo</label>
                            <input type="text" class="form-control" id="placa" name="placa" value="{{ $lote->placa }}"
                                    maxlength="7" required />
                        </div>

                        <div class="form-group">
                            <label for="conductor">Conductor del Vehículo</label>
                            <input type="text" class="form-control" id="conductor" name="conductor"
                                    value="{{ $lote->conductor }}" required />
                        </div>

                        <input name="ruc_ci" id="ruc_ci" type="hidden" value="{{ $lote->ruc_ci }}">
                        <input type="hidden" id="lotes_id" class="lotes_id" name="lotes_id" value="{{ $lote->id }}">
                        <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}" required />
                        <input type="hidden" id="anulado" name="anulado" value="0" required />
                        <input type="hidden" id="liquidado" name="liquidado" value="0" required />
                        <input type="hidden" id="visceras" name="visceras" value="0" required />
                        <input type="hidden" id="estado_egresos" name="estado_egresos" value="0" required />
                        <div class="row justify-content-around">
                            <a href="{{ route('pesobruto.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#proveedor').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#procedencia').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#placa').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#conductor').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });

    </script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

@endsection