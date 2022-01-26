@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>




    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR ASIGNACIÓN</h4>
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
                    <form method="post" action="{{ route('basculas.update', $editar->id) }}">
                        @csrf
                        @method('PATCH')


                        <div class="mb-3">
                            <select class="form-control" id="cod_bascula" name="cod_bascula" required>      
                            </select>
                        </div>
                        <input name="ipx_bascula" id="ipx_bascula" type="hidden">


                        <div class="mb-3">
                                <select class="form-control" id="nom_user" name="nom_user" required></select>
                            </div>

                        <div class="form-group">
                            <label for="nom_menu">Módulo</label>
                            <select class="custom-select" id="nom_menu" name="nom_menu" required>
                                <option value="INGRESOS">INGRESOS</option>
                                <option value="EGRESOS">EGRESOS</option>
                                <option value="ENTREGAS">ENTREGAS</option>
                            </select>
                        </div>

                        <div class="row justify-content-around">
                            <a href="{{ route('basculas.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script!-->
    <script type="text/javascript">
        //$(document).ready(function(){

            $('#cod_bascula').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            }); 

            $("#nom_menu").val("{{ $editar->nom_menu }}");
            $("#ipx_bascula").val("{{ $editar->ipx_bascula }}");
           
            $("#nom_user").append('<option value={{ $editar->nom_user }}> {{ $editar->nom_user }} </option>')

             $("#cod_bascula").append('<option value={{ $editar->cod_bascula }}> {{ $editar->cod_bascula }} </option>')

            $('#cod_bascula').select2({
                placeholder: 'Seleccione báscula',
                allowClear: true,
                minimumInputLenght: 1,
                ajax: {
                    url: '/ajax-autocomplete-search4',
                    dataType: 'json',
                    delay: 5,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.cod_bascula,
                                    id: item.cod_bascula,
                                    value: item.ipx_bascula
                                }
                            })
                        };
                    },
                    cache: true
                }
        }); 

        $('#cod_bascula').on('select2:select', function(e) {
            $('#ipx_bascula').val(e.params.data.value);
        })


        $('#nom_user').select2({
            placeholder: 'Seleccione usuario',
            ajax: {
                url: '/ajax-autocomplete-search2',
                dataType: 'json',
                delay: 5,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.username,
                                id: item.username,
                                value: item.username
                            }
                        })
                    };
                },
                cache: true
            }
        });



    </script>

@endsection
