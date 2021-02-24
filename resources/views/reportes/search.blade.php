@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Reportes PESO EN BRUTO</h4>
                    </div>
                </div>

                <div class="card-body">
                     <div class="row justify-content-around">

                        <div class="mb-3">
                            <form method="get" action="{{ route('reportes.show', 'search') }}">
                                <div class="input-group">

                                     <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_tipo" name="criterio_tipo" class="form-control"  placeholder="Buscar tipo"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_proveedor" name="criterio_proveedor" class="form-control"  placeholder="Buscar proveedor"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_procedencia" name="criterio_procedencia" class="form-control"  placeholder="Buscar procedencia">
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_placa" name="criterio_placa" class="form-control"  placeholder="Buscar placa">
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_conductor" name="criterio_conductor" class="form-control"  placeholder="Buscar conductor">
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_usuario" name="criterio_usuario" class="form-control"  placeholder="Buscar usuario">
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="criterio_anulado" value="1" name="criterio_anulado">
                                        <label class="form-check-label" for="inlineCheckbox1"> Anulado </label>
                                    </div>

                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="checkbox" id="criterio_liquidado" value="1" name="criterio_liquidado">
                                        <label class="form-check-label" for="inlineCheckbox2"> Liquidado </label>
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
                        <div class="alert alert-danger">No se ha encontrado ningún usuario bajo la búsqueda:
                            
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Tipo</td>
                                        <td>Proveedor</td>
                                        <td>Procedencia</td>
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                        <td>Usuario</td>
                                        <td>Anulado</td>
                                        <td>Liquidado</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($searches as $search)
                                        <tr>
                                            <td>{{ $search->id }}</td>
                                            <td>{{ $search->tipo }}</td>
                                            <td>{{ $search->proveedor }}</td>
                                            <td>{{ $search->procedencia }}</td>
                                            <td>{{ $search->placa }}</td>
                                            <td>{{ $search->conductor }}</td>
                                            <td>{{ $search->usuario }}</td>
                                            <td>
                                            @if ($search->anulado == '0')
                                                 <button class="btn btn-sm btn-primary" type="submit">NO</button>
                                                 @else
                                                  <button class="btn btn-sm btn-danger" type="submit">SI</button>
                                            @endif
                                             </td>

                                            <td>
                                                @if ($search->liquidado == '0')
                                                    <button type="button" class="btn btn-sm btn-primary">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success">SI</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($search->liquidado == '0')
                                                    <a href="{{ route('pesobruto.show', $search->id) }}"
                                                        class="btn btn-sm btn-primary">Registrar Pesos</a>
                                                @else
                                                    <a href="{{ route('pesobruto.show', $search->id) }}"
                                                        class="btn btn-sm btn-primary">Ver Pesos</a>
                                                @endif
                                            </td>
                                         
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
