@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Búsqueda de Clientes</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        
                        <div class="mb-3">
                            <a href="{{ route('clientes.index') }}" class="btn btn-primary">Volver Atrás</a>
                        </div>

                        <div class="mb-3">
                            <form method="get" action="{{ route('clientes.show', 'search') }}">
                                <div class="input-group">


                                   <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_ruc_ci" name="criterio_ruc_ci" class="form-control"  placeholder="Buscar RUC/CI"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_nombres" name="criterio_nombres" class="form-control"  placeholder="Buscar Nombres"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_rsocial" name="criterio_rsocial" class="form-control"  placeholder="Buscar Razón Social"  >
                                    </div>
                            
                                     <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_ciudad" name="criterio_ciudad" class="form-control"  placeholder="Buscar Ciudad"  >
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
                        <div class="alert alert-danger">No se ha encontrado ningún usuario.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Tipo</td>
                                        <td>RUC/CI</td>
                                        <td>Nombres</td>
                                        <td>Razón Social</td>
                                        <td>Dirección</td>
                                        <td>Teléfono</td>
                                        <td>Móvil</td>
                                        <td>Email</td>
                                        <td>Provincia</td>
                                        <td>Ciudad</td>
                                        <td>Parroquia</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($searches as $search)
                                        <tr>
                                            <td>{{ $search->id }}</td>
                                            <td>{{ $search->tipo }}</td>
                                            <td>{{ $search->ruc_ci }}</td>
                                            <td>{{ $search->nombres }}</td>
                                            <td>{{ $search->razon_social }}</td>
                                            <td>{{ $search->direccion }}</td>
                                            <td>{{ $search->telefono }}</td>
                                            <td>{{ $search->movil }}</td>
                                            <td>{{ $search->email }}</td>
                                            <td>{{ $search->provincia }}</td>
                                            <td>{{ $search->ciudad }}</td>
                                            <td>{{ $search->parroquia }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="row justify-content-around">
                        {{ $searches->withQueryString()->links() }}
                        {{-- <span>Total de Usuarios: <b>{{ $count }}</b></span>
                        --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
