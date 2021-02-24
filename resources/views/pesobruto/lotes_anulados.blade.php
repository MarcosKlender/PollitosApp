@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>LOTES ANULADOS - PESO EN BRUTO</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('pesobruto.index') }}" class="btn btn-primary">Volver Atrás</a>
                        </div>
                    </div>
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($count == 0)
                        <div class="alert alert-danger">No se han encontrado lotes anulados.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Tipo</td>
                                        <td>Proveedor</td>
                                        <td>RUC/CI</td>
                                        <td>Procedencia</td>
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                        <td>Usuario</td>
                                        <td>Observaciones</td>
                                        <td>Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote)
                                        <tr>
                                            <td>{{ $lote->id }}</td>
                                            <td>{{ $lote->tipo }}</td>
                                            <td>{{ $lote->proveedor }}</td>
                                            <td>{{ $lote->ruc_ci }}</td>
                                            <td>{{ $lote->procedencia }}</td>
                                            <td>{{ $lote->placa }}</td>
                                            <td>{{ $lote->conductor }}</td>
                                            <td>{{ $lote->usuario }}</td>
                                            <td>{{ $lote->observaciones }}</td>
                                            <td>{{ $lote->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $lotes->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
