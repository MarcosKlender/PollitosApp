@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>NUEVO REGISTRO - PESO EN BRUTO</h4>
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
                    <form method="post" action="{{ route('pesobruto.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="tipo">Tipo de Animal</label>
                            <select class="custom-select" id="tipo" name="tipo" required>
                                <option value="" selected disabled>Elija un tipo de animal</option>
                                <option value="POLLOS">POLLOS</option>
                                <option value="CERDOS">CERDOS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <select class="form-control" id="proveedor" name="proveedor" required>
                                <option value="" selected disabled>Elija un proveedor</option>
                                @foreach ($proveedores as $proveedor => $value)
                                    <option value="{{ $value }}"> 
                                        {{ $value }} 
                                    </option>
                                @endforeach    
                            </select>
                            {{-- <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ old('proveedor') }}" required /> --}}
                        </div>
                        <div class="form-group">
                            <label for="procedencia">Procedencia</label>
                            <input type="text" class="form-control" id="procedencia" name="procedencia" value="{{ old('procedencia') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="placa">Placa del Vehículo</label>
                            <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa') }}" maxlength="7" required />
                        </div>
                        <div class="form-group">
                            <label for="conductor">Conductor del Vehículo</label>
                            <input type="text" class="form-control" id="conductor" name="conductor" value="{{ old('conductor') }}" required />
                        </div>
                        <input type="hidden" id="usuario" name="usuario" value="{{  Auth::user()->username }}" required />
                        <input type="hidden" id="anulado" name="anulado" value="0" required />
                        <input type="hidden" id="liquidado" name="liquidado" value="0" required />
                        <div class="row justify-content-around">
                            <a href="{{ route('pesobruto.index') }}" class="btn btn-danger">Cancelar</a>
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

@endsection
