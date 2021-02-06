@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>REGISTROS ANULADOS - PESO EN BRUTO</h4>
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
                        <div class="alert alert-danger">No se han encontrado registros anulados.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID Registro</td>
                                        <td>ID Lote</td>
                                        <td>Cantidad Gavetas</td>
                                        {{-- <td>Cantidad Pollos</td> --}}
                                        <td>Peso Bruto</td>
                                        <td>Peso Gavetas</td>
                                        <td>Peso Final</td>
                                        <td>Usuario</td>
                                        <td>Fecha de Creación</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                        <tr>
                                            <td>{{ $registro->id }}</td>
                                            <td>{{ $registro->lotes_id }}</td>
                                            <td>{{ $registro->cant_gavetas }}</td>
                                            {{-- @if ($registro->cant_pollos == null) @else <td>{{ $registro->cant_pollos }}</td> @endif --}}
                                            <td>{{ $registro->peso_bruto }}</td>
                                            <td>{{ $registro->peso_gavetas }}</td>
                                            <td>{{ $registro->peso_final }}</td>
                                            <td>{{ $registro->usuario }}</td>
                                            <td>{{ $registro->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $registros->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
