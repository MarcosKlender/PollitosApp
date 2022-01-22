@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

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

                        <div class="form-group">
                            <label for="cod_bascula">Código Báscula</label>
                            <input type="text" class="form-control" id="cod_bascula" name="cod_bascula"
                                value="{{ $editar->cod_bascula }}" required />
                        </div>

                        <div class="form-group">
                            <label for="nom_user">Usuario</label>
                            <input type="text" class="form-control" id="nom_user" name="nom_user"
                                value="{{ $editar->nom_user }}" required />
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#nom_menu").val("{{ $editar->nom_menu }}");

            $('#cod_bascula').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>

@endsection
