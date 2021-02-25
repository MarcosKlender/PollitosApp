@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Administración de Proveedores</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        
                       
                        
                        <div class="mb-3">
                            <form method="get" action="{{ route('proveedores.show', 'search') }}">

                                <div class="input-group">
                               

                                     <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_ruc_ci" name="criterio_ruc_ci" class="form-control"  placeholder="Buscar RUC/CI"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_nombres" name="criterio_nombres" class="form-control"  placeholder="Buscar proveedor"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_rsocial" name="criterio_rsocial" class="form-control"  placeholder="Buscar razon social"  >
                                    </div>
                            
                                     <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_ciudad" name="criterio_ciudad" class="form-control"  placeholder="Buscar ciudad"  >
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
                                @foreach ($proveedores as $provedor)
                                    <tr>
                                        <td>{{ $provedor->id }}</td>
                                        <td>{{ $provedor->tipo }}</td>
                                        <td>{{ $provedor->ruc_ci }}</td>
                                        <td>{{ $provedor->nombres }}</td>
                                        <td>{{ $provedor->razon_social }}</td>
                                        <td>{{ $provedor->direccion }}</td>
                                        <td>{{ $provedor->telefono }}</td>
                                        <td>{{ $provedor->movil }}</td>
                                        <td>{{ $provedor->email }}</td>
                                        <td>{{ $provedor->provincia }}</td>
                                        <td>{{ $provedor->ciudad }}</td>
                                        <td>{{ $provedor->parroquia }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-around">
                        {{ $proveedores->links() }}
                        {{-- <span>Total de Usuarios: <b>{{ $count }}</b></span>
                        --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
