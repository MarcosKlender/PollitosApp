@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Administración de Usuarios</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('admin.create') }}" class="btn btn-success">Crear Usuario</a>
                        </div>
                        <div class="mb-3 col-lg-3">
                            <form action="{{ route('admin.show', 'search') }}" method="get" role="search">
                                <div class="input-group">
                                    <input type="search" id="username" name="username" class="form-control border"
                                        placeholder="Nombre de Usuario" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary border" type="submit">Búsqueda</button>
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
                                    <td>Rol</td>
                                    <td>Nombre de Usuario</td>
                                    <td>Nombres</td>
                                    <td>Apellidos</td>
                                    <td>Email</td>
                                    <td>Usuario Activo</td>
                                    <td>Creado</td>
                                    <td>Modificado</td>
                                    <td class="text-center">Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->rol->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        @if ($user->active == 1)
                                            <td>Sí</td>
                                        @else
                                            <td>No</td>
                                        @endif
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.edit', $user->id) }}"
                                                class="btn btn-primary">Editar</a>
                                            {{-- <form
                                                action=" {{ route('admin.destroy', $user->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-around">
                        {{ $users->links() }}
                        {{-- <span>Total de Usuarios: <b>{{ $count }}</b></span>
                        --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
