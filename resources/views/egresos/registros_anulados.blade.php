@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>REGISTROS ANULADOS - EGRESOS</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('egresos.index') }}" class="btn btn-primary">Volver Atrás</a>
                        </div>
                    </div>
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($count == 0)
                        <div class="alert alert-danger">No se han encontrado registros anulados.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID Registro</td>
                                        <td>ID Lote</td>
                                        <td>Peso Bruto</td>
                                        <td>Peso Gavetas</td>
                                        <td>Peso Final</td>
                                        <td>Usuario</td>
                                        <td>Observaciones</td>
                                        <td>Fecha de Anulación</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($egresos as $egreso)
                                        <tr>
                                            <td>{{ $egreso->id }}</td>
                                            <td>{{ $egreso->lotes_id }}</td>
                                            <td>{{ $egreso->peso_bruto }}</td>
                                            <td>{{ $egreso->peso_gavetas }}</td>
                                            <td>{{ $egreso->peso_final }}</td>
                                            <td>{{ $egreso->usuario }}</td>
                                            <td>{{ $egreso->observaciones }}</td>
                                            <td>{{ $egreso->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $egresos->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
