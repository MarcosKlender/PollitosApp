@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Búsqueda de Configuraciones</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">

                        <div class="mb-3">
                            <a href="{{ route('configuracion.index') }}" class="btn btn-primary">Volver Atrás</a>
                        </div>

                        <div class="mb-3">
                            <form method="get" action="{{ route('configuracion.show', 'search') }}">
                                <div class="input-group">

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_modulo" name="criterio_modulo"
                                            class="form-control" placeholder="Buscar módulo">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_descripcion" name="criterio_descripcion"
                                            class="form-control" placeholder="Buscar descripción">
                                    </div>

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary border" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    @if ($count == 0)
                        <div class="alert alert-danger">No se ha encontrado ningúna configuración.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="font-weight-bold">
                                    <td align="center">ID</td>
                                    <td align="center">Módulo</td>
                                    <td align="center">Descripción</td>
                                    <td align="center">Elemento</td>
                                    <td align="center">Valor</td>
                                    <td align="center">Estado</td>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($searches as $search)
                                        <tr>
                                            <td align="center">{{ $search->id }}</td>
                                            <td align="center">{{ $search->mod_conf }}</td>
                                            <td align="center">{{ $search->des_conf }}</td>
                                            <td align="center">{{ $search->ele_conf }}</td>
                                            <td align="center">{{ $search->val_conf }}</td>
                                            <td align="center">{{ $search->est_conf }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="row justify-content-around">
                        {{ $searches->withQueryString()->links() }}
                        {{-- <span>Total de configuraciones: <b>{{ $count }}</b></span> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
