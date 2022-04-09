@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR REGISTRO - PESO EN BRUTO - LOTE N° {{$lote->id}}</h4>
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
                            <select class="custom-select" id="tipo" name="tipo" required>
                                <option value="POLLOS">POLLOS</option>
                                <option value="CERDOS">CERDOS</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="cantidad">Cantidad Animales</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad"
                                    value="{{ $lote->cantidad }}" required />
                        </div>
    
                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <select class="form-control" id="proveedor_nombre" name="proveedor_nombre" required>      
                            </select>
                        
                            <!--  muestra ruc/ci de proveedores !-->
                            <input name="proveedor" id="proveedor" type="hidden" >
                            <input name="ruc_ci" id="ruc_ci" type="hidden" >
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#tipo').val("{{ $lote->tipo }}");

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


        $("#proveedor").val("{{ $lote->proveedor }}");
        $("#ruc_ci").val("{{ $lote->ruc_ci }}");

        $("#proveedor_nombre").append('<option value={{ $lote->proveedor }}> {{ $lote->proveedor }} </option>');

        $('#proveedor_nombre').select2({
            placeholder: 'Seleccione proveedor',
            allowClear: true,
            minimumInputLenght: 1,
            ajax: {
                url: '/ajax-autocomplete-search',
                dataType: 'json',
                delay: 5,
                processResults: function(data) {                    
                    return {
                        results: $.map(data, function(item) {                            
                            return {
                                text: item.pro_nombre,
                                id: item.pro_ruc,
                                value: item.pro_nombre
                            }
                        })
                    };
                },
                cache: true
            }
        });


       $('#proveedor_nombre').on('select2:select',function(e){
             $('#proveedor').val(e.params.data.text);
             $('#ruc_ci').val(e.params.data.id);
             //console.log(e.params.data.text, e.params.data.id);
        }) 


    </script>


@endsection