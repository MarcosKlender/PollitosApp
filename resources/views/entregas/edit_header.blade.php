@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR ENTREGA {{ $entregas->id }}</h4>
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
                    <form method="post" action="{{ route('entregas.update_header') }}">
                        @csrf
                        <div class="form-group">
                            <label for="tipo">Tipo de Animal</label>
                            <select class="custom-select" id="tipo" name="tipo" required>
                                <option value="POLLOS">POLLOS</option>
                                <option value="CERDOS">CERDOS</option>
                            </select>
                        </div>


                         <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <select class="form-control" id="cliente_nombre" name="cliente_nombre" required>      
                            </select>
                        
                             <!--  muestra ruc/ci de clientes !-->
                            <input name="cliente" id="cliente" type="hidden">
                            <input name="ruc_ci" id="ruc_ci" type="hidden">
                        </div>

                        <div class="form-group">
                            <label for="placa">Placa del Vehículo</label>
                            <input type="text" class="form-control" id="placa" name="placa" value="{{ $entregas->placa }}"
                                maxlength="7"  />
                        </div>
                        <div class="form-group">
                            <label for="conductor">Conductor del Vehículo</label>
                            <input type="text" class="form-control" id="conductor" name="conductor"
                                value="{{ $entregas->conductor }}"  />
                        </div>

                        <div class="form-group">
                            <label for="destino">Destino</label>
                            <input type="text" class="form-control" id="destino" name="destino"
                                value="{{ $entregas->destino }}"  />
                        </div>

                        <div class="form-group text-center">
                            <div class="form-check">
                                <input type="hidden" class="form-check-label" value="0" name="tipo_entrega" id="tipo_entrega">
                                @if ($entregas->tipo_entrega == 1)
                                    <input type="checkbox" class="form-check-label" value="1" name="tipo_entrega" id="tipo_entrega" checked>    
                                @else
                                    <input type="checkbox" class="form-check-label" value="1" name="tipo_entrega" id="tipo_entrega">
                                @endif
                                <label class="form-check-label" for="tipo_entrega">Para Local</label>
                            </div>
                        </div>
                        
                        <input type="hidden" id="entregas_id" class="entregas_id" name="entregas_id" value="{{ $entregas->id }}">
                        <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}" required />
                        <input type="hidden" id="anulado" name="anulado" value="0" required />
                        <input type="hidden" id="liquidado" name="liquidado" value="0" required />
                        <div class="row justify-content-around">
                            <a href="{{ route('entregas.index') }}" class="btn btn-danger">Cancelar</a>
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
            $('#tipo').val("{{ $entregas->tipo }}");

            $('#cliente').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#placa').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#conductor').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#destino').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script type="text/javascript">

        $("#cliente").val("{{ $entregas->cliente }}");
        $("#ruc_ci").val("{{ $entregas->ruc_ci }}");

        $("#cliente_nombre").append('<option value={{ $entregas->cliente }}> {{ $entregas->cliente }} </option>');
        $('#cliente_nombre').select2({
            ajax: {
                url: '/ajax-autocomplete-search3',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nombres,
                                id: item.ruc_ci,
                                value: item.nombres
                            }
                        })
                    };
                },
                cache: true
            },
            placeholder: 'Seleccione cliente'
        });

        $('#cliente_nombre').on('select2:select', function(e) {
            $('#cliente').val(e.params.data.text);
            $('#ruc_ci').val(e.params.data.id);
            console.log(e.params.data.text, e.params.data.id);
        })

    </script>

@endsection
