@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>LOTE {{ $lote->id }} - {{ $lote->tipo }}</h4>
                </div>
                <div class="card-body">
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row justify-content-around">
                        <a href="{{ route('pesobruto.index') }}" class="btn btn-primary">Volver Atrás</a>
                    </div>

                    @if (count($registros) != 0)
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>ID Lote</td>
                                        <td>Cantidad de Gavetas</td>
                                        <td>Peso Bruto</td>
                                        <td>Peso Gavetas</td>
                                        <td>Peso Final</td>
                                        <td>Usuario</td>
                                        <td>Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                        <tr>
                                            <td>{{ $registro->id }}</td>
                                            <td>{{ $registro->lotes_id }}</td>
                                            <td>{{ $registro->cant_gavetas }}</td>
                                            <td>{{ $registro->peso_bruto }}</td>
                                            <td>{{ $registro->peso_gavetas }}</td>
                                            <td>{{ $registro->peso_final }}</td>
                                            <td>{{ $registro->usuario }}</td>
                                            <td>{{ $registro->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2"><b>TOTAL</b></td>
                                        <td><b>{{ $total_cantidad }}</b></td>
                                        <td><b>{{ $total_bruto }}</b></td>
                                        <td><b>{{ $total_gavetas }}</b></td>
                                        <td><b>{{ $total_final }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
