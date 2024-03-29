@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- switch botton !-->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Asignación de Básculas</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <!--form method="POST" action=""!-->
                        <form method="POST" action="{{ route('basculas.store') }}">
                            @csrf

                            <div class="mb-3">
                                <select class="form-control" id="cod_bascula" name="cod_bascula" required></select>
                            </div>
                            <input name="ipx_bascula" id="ipx_bascula" type="hidden">

                            <div class="mb-3">
                                <select class="form-control" id="nom_user" name="nom_user" required></select>
                            </div>

                            <select class="form-control" id="nom_menu" name="nom_menu" required
                                onchange="javascript:prueba()">
                                <option value="" selected disabled>Seleccione módulo</option>
                                <option value="INGRESOS">INGRESOS</option>
                                <option value="EGRESOS">EGRESOS</option>
                                <option value="ENTREGAS">ENTREGAS</option>
                            </select>

                            <br>
                            <input type="hidden" id="tipo_peso" name="tipo_peso" value="lb">
                            <input type="hidden" id="automatico" name="automatico" value="0">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>

                    <br>
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <!--th>ID Báscula</th!-->
                                    <th>Código Báscula</th>
                                    <th>Módulo</th>
                                    <th>Usuario</th>
                                    <th>Tipo Peso (Libras/Kilogramos)</th>
                                    <th>Automático</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($basculas as $bascula)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <!--td>{{ $bascula->id }}</td!-->
                                        <td> {{ $bascula->cod_bascula }} </td>
                                        <td>{{ $bascula->nom_menu }}</td>
                                        <td>{{ $bascula->nom_user }}</td>
                                        {{-- <td>{{ $bascula->tipo_peso }}</td> --}}
                                        <td>
                                            @if ($bascula->tipo_peso == 'lb')
                                                <form method="post" action="{{ route('basculas.update', $bascula->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <input type="hidden" id="tipo_peso" name="tipo_peso" value="kg">
                                                    <button type="submit" class="btn btn-sm btn-primary">Libras</button>
                                                </form>
                                            @else
                                                <form method="post"
                                                    action="{{ route('basculas.update', $bascula->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <input type="hidden" id="tipo_peso" name="tipo_peso" value="lb">
                                                    <button type="submit" class="btn btn-sm btn-success">Kilogramos</button>
                                                </form>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $bascula->automatico }}</td> --}}
                                        <td>
                                            @if ($bascula->automatico == '0')
                                                <form method="post"
                                                    action="{{ route('basculas.update', $bascula->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <input type="hidden" id="automatico" name="automatico" value="1">
                                                    <button type="submit" class="btn btn-sm btn-primary">NO</button>
                                                </form>
                                            @else
                                                <form method="post"
                                                    action="{{ route('basculas.update', $bascula->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <input type="hidden" id="automatico" name="automatico" value="0">
                                                    <button type="submit" class="btn btn-sm btn-success">SI</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <form method="post" action="{{ url('/basculas/' . $bascula->id) }}">
                                                <a href="{{ route('basculas.edit', $bascula->id) }}"
                                                    class="btn btn-primary"><i class="far fa-edit"></i></a>

                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" type="submit"
                                                    onclick="return confirm('¿Está seguro de eliminar esta báscula?');"><i
                                                        class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
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

        $('#cod_bascula').select2({
            placeholder: 'Seleccione báscula',
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
    </script>
@endsection
