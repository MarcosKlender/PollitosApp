@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>EDITAR BÁSCULA</h4>
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
                    <form method="post" action="{{ route('basculaconfiguracion.update', $editar->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="cod_bascula">Código Báscula</label>
                            <input type="text" class="form-control" id="cod_bascula" name="cod_bascula"
                                value="{{ $editar->cod_bascula }}" required />
                        </div>

                        <div class="form-group">
                            <label for="nom_bascula">Nombre</label>
                            <input type="text" class="form-control" id="nom_bascula" name="nom_bascula"
                                value="{{ $editar->nom_bascula }}" required />
                        </div>
                        <div class="form-group">
                            <label for="ipx_bascula">Dirección IP</label>
                            <input type="text" class="form-control" id="ipx_bascula" name="ipx_bascula"
                                value="{{ $editar->ipx_bascula }}" required />
                        </div>
                        <div class="form-group">
                            <label for="est_bascula">Estado</label>
                            <select class="custom-select" id="est_bascula" name="est_bascula" required>
                                <option value="" selected disabled>Elije un estado </option>
                                <option value="0">ACTIVO</option>
                                <option value="1">INACTIVO</option>
                            </select>
                        </div>

                        <div class="row justify-content-around">
                            <a href="{{ route('basculaconfiguracion.index') }}" class="btn btn-danger">Cancelar</a>
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
            $("#est_bascula").val("{{ $editar->est_bascula }}");

            $('#cod_bascula').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#nom_bascula').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>

@endsection
