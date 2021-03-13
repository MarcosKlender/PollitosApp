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
                            <a href="{{ route('proveedores.create') }}" class="btn btn-success">Crear Proveedor</a>
                        </div>

                        <div class="mb-3">
                            <form method="get" action="{{ route('proveedores.show', 'search') }}">

                                <div class="input-group">
                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_ruc_ci" name="criterio_ruc_ci"
                                            class="form-control" placeholder="Buscar RUC/CI">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_nombres" name="criterio_nombres"
                                            class="form-control" placeholder="Buscar proveedor">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_rsocial" name="criterio_rsocial"
                                            class="form-control" placeholder="Buscar razon social">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_ciudad" name="criterio_ciudad"
                                            class="form-control" placeholder="Buscar ciudad">
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
                                    <td>RUC/CI</td>
                                    <td>Nombres</td>
                                    <td>Nombre Comercial</td>
                                    <td>Teléfono</td>
                                    <td>Email</td>

                                    <td>Direccion</td>

                                    <td>Provincia</td>
                                    <td>Ciudad</td>
                                    <td>Parroquia</td>
                                    <td>Acciones</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proveedores as $proveedor)
                                    <tr>

                                      <td>{{ $provedor->id }}</td>
                                        <td>{{ $provedor->pro_ruc }}</td>
                                        <td>{{ $provedor->pro_nombre }}</td>
                                        <td>{{ $provedor->pro_nombre_comercial }}</td>
                                        <td>{{ $provedor->pro_telefonos }}</td>
                                        <td>{{ $provedor->pro_email }}</td>
                                        <td>{{ $provedor->pro_direccion }}</td>

                                        <td>{{ $proveedor->id }}</td>
                                        <td>{{ $proveedor->tipo }}</td>
                                        <td>{{ $proveedor->ruc_ci }}</td>
                                        <td>{{ $proveedor->nombres }}</td>
                                        <td>{{ $proveedor->razon_social }}</td>
                                        <td>{{ $proveedor->direccion }}</td>
                                        <td>{{ $proveedor->telefono }}</td>
                                        <td>{{ $proveedor->movil }}</td>
                                        <td>{{ $proveedor->email }}</td>
                                        <td>{{ $proveedor->provincia }}</td>
                                        <td>{{ $proveedor->ciudad }}</td>
                                        <td>{{ $proveedor->parroquia }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('proveedores.edit', $proveedor->id) }}"
                                                class="btn btn-primary">Editar</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-around">
                        {{ $proveedores->links() }}
                        {{-- <span>Total de Usuarios: <b>{{ $count }}</b></span> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
