@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>REGISTROS ANULADOS - ENTREGAS</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('entregas.index') }}" class="btn btn-primary">Volver Atrás</a>
                        </div>
                    </div>

                    @if ($count == 0)
                        <div class="alert alert-danger">No se han encontrado registros anulados.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>ID Registro</td>
                                        <td>ID Lote</td>
                                        <td>Cantidad Gavetas</td>
                                        <td>Peso Bruto</td>
                                        <td>Usuario</td>
                                        <td>Observaciones</td>
                                        <td>Fecha de Anulación</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                        <tr>
                                            <td>{{ $registro->id }}</td>
                                            <td>{{ $registro->entregas_id }}</td>
                                            <td>{{ $registro->cant_gavetas }}</td>
                                            <td>{{ $registro->peso_bruto }}</td>
                                            <td>{{ $registro->usuario }}</td>
                                            <td>{{ $registro->observaciones }}</td>
                                            <td>{{ $registro->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $registros->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection