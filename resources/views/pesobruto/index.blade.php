@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Lotes - Registro de Peso en Bruto</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('pesobruto.create') }}" class="btn btn-success">Nuevo Registro</a>
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
                                    <td>Proveedor</td>
                                    <td>Procedencia</td>
                                    <td>Placa</td>
                                    <td>Conductor</td>
                                    <td>Cantidad de Gavetas</td>
                                    <td>Cantidad de Pollos</td>
                                    <td>Peso</td>
                                    <td>Usuario</td>
                                    <td>Fecha de Registro</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lotes as $lote)
                                    <tr>
                                        <td>{{ $lote->id }}</td>
                                        <td>{{ $lote->tipo }}</td>
                                        <td>{{ $lote->proveedor }}</td>
                                        <td>{{ $lote->procedencia }}</td>
                                        <td>{{ $lote->placa }}</td>
                                        <td>{{ $lote->conductor }}</td>
                                        <td>{{ $lote->cant_gavetas }}</td>
                                        <td>{{ $lote->cant_pollos }}</td>
                                        <td>{{ $lote->peso }}</td>
                                        <td>{{ $lote->usuario }}</td>
                                        <td>{{ $lote->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-around">
                        {{ $lotes->links() }}
                        {{-- <span>Total de Lotes: <b>{{ $count }}</b></span> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
