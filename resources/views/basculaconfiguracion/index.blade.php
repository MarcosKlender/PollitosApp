@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <h4>Configuración de Básculas</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <!--form method="POST" action=""!-->
                        <form method="POST" action="{{ route('basculaconfiguracion.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nombre Báscula</label>
                                <input type="text" class="form-control" id="nom_bascula" name="nom_bascula"
                                    value="{{ old('nom_bascula') }}" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> Dirección IP</label>
                                <input type="text" class="form-control" id="ipx_bascula" name="ipx_bascula"
                                    placeholder="000.000.000.000" value="{{ old('ipx_bascula') }}" required />
                            </div>

                            <input type="hidden" id="est_bascula" name="est_bascula" value="0" />
                            <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}" required />

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
                                    <th>Código Báscula </th>
                                    <th>Nombre</th>
                                    <th>Dirección IP</th>
                                    <th>Estado</th>
                                    <th>Usuario creación</th>
                                    <th>Fecha de Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($basculas as $bascula)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <!--td>{{-- $bascula->id --}}</td!-->
                                        <td>{{ $bascula->cod_bascula }} </td>
                                        <td>{{ $bascula->nom_bascula }}</td>
                                        <td>{{ $bascula->ipx_bascula }}</td>
                                        @if ($bascula->est_bascula == 0)
                                            <td>ACTIVO</td>
                                        @else
                                            <td>INACTIVO</td>
                                        @endif
                                        <td>{{ $bascula->usuario_creacion }}</td>
                                        <td>{{ $bascula->created_at }}</td>
                                        <td>
                                            <a href="{{ route('basculaconfiguracion.edit', $bascula->id) }}"
                                                class="btn btn-primary"><i class="far fa-edit"></i></a>
                                        </td>
                                        {{-- <td>
                                            <form method="post"
                                                action="{{ url('/basculaconfiguracion/' . $bascula->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" type="submit"
                                                    onclick="return confirm('¿Desea eliminar?');"><i
                                                        class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td> --}}
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
        $('.nom_user').select2({
            placeholder: 'Seleccione el usuario',
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

        $(document).ready(function() {
            $('#nom_bascula').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection
