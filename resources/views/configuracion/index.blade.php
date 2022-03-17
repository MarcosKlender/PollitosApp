@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Configuración</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">

                        <div class="mb-3">
                            <a href="{{ route('configuracion.create') }}" class="btn btn-success">Crear Configuración</a>
                        </div>

                        <div class="mb-3">
                            <form method="get" action="{{ route('configuracion.show', 'search') }}">

                                <div class="input-group">
                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_modulo" name="criterio_modulo"
                                            class="form-control" placeholder="Buscar Módulo">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_descripcion" name="criterio_descripcion"
                                            class="form-control" placeholder="Buscar Descripción">
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
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td align="center">ID</td>
                                    <td align="center">Módulo</td>
                                    <td align="center">Descripción</td>
                                    <td align="center">Automatico</td>
                                    <td align="center">Elemento</td>
                                    <td align="center">Valor</td>
                                    <td align="center">Estado</td>
                                    <td align="center">Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($configuracion as $configurar)
                                    <tr>
                                        <td align="center">{{ $configurar->id }}</td>
                                        <td align="center">{{ $configurar->mod_conf }}</td>
                                        <td align="center">{{ $configurar->des_conf }}</td>
                                        <td align="center">
                                       
                                        @if($configurar->aut_conf == 0 )
                                             <form method="post" action="{{ route('configuracion.update', $configurar->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="aut_conf" name="aut_conf" value="1">
                                                <button type="submit" class="btn btn-sm btn-info">NO</button>
                                            </form>
                                             @elseif($configurar->aut_conf == 1)
                                            <form method="post" action="{{ route('configuracion.update', $configurar->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="aut_conf" name="aut_conf" value="0">
                                                <button type="submit" class="btn btn-sm btn-warning">SI</button>
                                            </form>
                                             @endif   
                                            <!--td align="center">{{ $configurar->aut_conf}}</td!-->
                                        </td>
                                        <td align="center">{{ $configurar->ele_conf }}</td>
                                        <td align="center">{{ $configurar->val_conf }}</td>
                                        @if ($configurar->est_conf == 0)
                                            <td align="center">ACTIVO</td>
                                        @else
                                            <td align="center">INACTIVO</td>
                                        @endif
                                        <td class="text-center">
                                            <a href="{{ route('configuracion.edit', $configurar->id) }}"
                                                class="btn btn-primary"><i class="far fa-edit"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-around">
                        {{ $configuracion->links() }}
                        {{-- <span>Total de Usuarios: <b>{{ $count }}</b></span> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
