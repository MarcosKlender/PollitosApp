@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>ENTREGAS ANULADAS</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="javascript:history.back()" class="btn btn-primary">Volver Atrás</a>
                        </div>
                    </div>
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($count == 0)
                        <div class="alert alert-danger">No se han encontrado entregas anuladas.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>ID</td>
                                        <td>Tipo Animal</td>
                                        <td>RUC/CI</td>
                                        <td>Cliente</td>
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                        <td>Destino</td>
                                        <td>Cantidad Animales</td>
                                        <td>Usuario creación</td>
                                        <td>Fecha de Anulación</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entregas as $entrega)
                                        <tr>
                                            <td>{{ $entrega->id }}</td>
                                            <td>{{ $entrega->tipo }}</td>
                                            <td>{{ $entrega->ruc_ci }}</td>
                                            <td>{{ $entrega->cliente }}</td>
                                            <td>{{ $entrega->placa }}</td>
                                            <td>{{ $entrega->conductor }}</td>
                                            <td>{{ $entrega->destino }}</td>
                                            <td>{{ $entrega->cant_animales }}</td>
                                            <td>{{ $entrega->usuario_creacion }}</td>
                                            <td>{{ $entrega->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $entregas->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
