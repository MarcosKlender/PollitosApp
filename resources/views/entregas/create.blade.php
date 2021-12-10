@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>NUEVA ENTREGA</h4>
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
                    <form method="post" action="{{ route('entregas.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                                <select class="form-control" id="cliente_nombre" name="cliente_nombre" required>
                                    <option value="" selected disabled>Elija un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option >
                                            {{ $cliente->nombres }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--  muestra ruc/ci de clientes !-->
                                <input name="cliente" id="cliente" type="hidden" >
                                <input name="ruc_ci" id="ruc_ci" type="hidden" >

                            {{--<input type="text" class="form-control" id="cliente" name="cliente"
                                value="{{ old('cliente') }}" required />--}}
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
                        <div class="form-group">
                            <label for="peso_entrega">Peso Entrega</label>
                            <input type="number" class="form-control" id="peso_entrega" name="peso_entrega"
                                value="{{ old('peso_entrega') }}" step=".01" required />
                        </div>
                        <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->username }}" required />
                        <input type="hidden" id="anulado" name="anulado" value="0" required />
                        <div class="row justify-content-around">
                            <a href="{{ route('entregas.index') }}" class="btn btn-danger">Cancelar</a>
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
            $('#cliente').keyup(function() {
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


     <script type="text/javascript">
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


        $('#cliente_nombre').on('select2:select',function(e){
             $('#cliente').val(e.params.data.text);
             $('#ruc_ci').val(e.params.data.id);
             console.log(e.params.data.text, e.params.data.id);
        })


       /* function prueba() {
            var p = document.getElementById("proveedor");
            document.getElementById("ruc").value = p.value;
        } */

    </script> 

@endsection
