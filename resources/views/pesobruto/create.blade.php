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
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad"
                                value="{{ old('cantidad') }}" required />
                        </div>

                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <select class="form-control" id="proveedor_nombre" name="proveedor_nombre" required>
                                <option value="" selected disabled>Elija un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option >
                                        {{ $proveedor->pro_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <!--  muestra ruc/ci de proveedores !-->
                            <input name="proveedor" id="proveedor" type="hidden" >
                            <input name="ruc_ci" id="ruc_ci" type="hidden" >

                            {{-- <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ old('proveedor') }}" required /> --}}
                        </div>

                        {{-- <div class="form-group">
                            <label for="proveedor">Proveedor</label>

                            <!--  visualiza proveedores !-->
                            <!--select class="form-control" id="proveedor" onchange="javascript:prueba()" required> </select!-->

                            <!--  muestra ruc/ci de proveedores !-->
                            <!--input name="ruc" id="ruc" type="hidden"!-->

                            <input type="text" class="form-control" id="proveedor" name="proveedor"
                                value="{{ old('proveedor') }}" required />
                        </div> --}}

                        <div class="form-group">
                            <label for="procedencia">Procedencia</label>
                            <input type="text" class="form-control" id="procedencia" name="procedencia"
                                value="{{ old('procedencia') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="placa">Placa del Vehículo</label>
                            <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa') }}"
                                maxlength="7" required />
                        </div>
                        <div class="form-group">
                            <label for="conductor">Conductor del Vehículo</label>
                            <input type="text" class="form-control" id="conductor" name="conductor"
                                value="{{ old('conductor') }}" required />
                        </div>
                        <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}" required />
                        <input type="hidden" id="anulado" name="anulado" value="0" required />
                        <input type="hidden" id="liquidado" name="liquidado" value="0" required />
                        <input type="hidden" id="visceras" name="visceras" value="0" required />
                        <input type="hidden" id="estado_egresos" name="estado_egresos" value="0" required />
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


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $('#proveedor_nombre').select2({
            ajax: {
                url: '/ajax-autocomplete-search',
                dataType: 'json',
                delay: 250,
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
            },
            placeholder: 'Seleccione proveedor'
        });


        $('#proveedor_nombre').on('select2:select',function(e){
             $('#proveedor').val(e.params.data.text);
             $('#ruc_ci').val(e.params.data.id);
             console.log(e.params.data.text, e.params.data.id);
        })


       /* function prueba() {
            var p = document.getElementById("proveedor");
            document.getElementById("ruc").value = p.value;
        } */

    </script> 


@endsection
