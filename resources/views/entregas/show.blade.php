@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>LOTE {{ $entregas->id }} - {{ $entregas->tipo }} - ENTREGAS</h4>
                </div>

                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pesos" role="tab"
                            aria-controls="pesos" aria-selected="true">
                            <h6 class="font-weight-bold">REGISTRO DE PESOS<label id="nombre_pesos"></label></h6>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#gavetas" role="tab"
                            aria-controls="gavetas" aria-selected="false">
                            <h6 class="font-weight-bold">PRESAS A ENTREGAR<label id="nombre_gavetas"></label></h6>
                        </a>
                    </li>
                </ul>

                <div class="card-body">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pesos" role="tabpanel" aria-labelledby="pesos">

                            <div class="row justify-content-around">
                                <a href="{{ route('entregas.index') }}" class="btn btn-primary">Volver Atrás</a>
                            </div>

                            @if (count($registros) != 0)
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>N°</td>
                                                <td>ID Lote</td>
                                                <td>Cantidad de Gavetas</td>
                                                <td>Tipo Peso</td>
                                                <td>Peso Bruto</td>
                                                <td>Usuario</td>
                                                <td>Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registros as $registro)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $registro->entregas_id }}</td>
                                                    <td>{{ $registro->cant_gavetas }}</td>
                                                    <td>{{ $registro->tipo_peso }}</td>
                                                    <td>{{ $registro->peso_bruto }}</td>
                                                    <td>{{ $registro->usuario }}</td>
                                                    <td>{{ $registro->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>

                        <div class="tab-pane fade" id="gavetas" role="tabpanel" aria-labelledby="gavetas">

                            <div class="row justify-content-around">
                                <a href="{{ route('entregas.index') }}" class="btn btn-primary">Volver Atrás</a>
                            </div>

                            @if (count($presas) != 0)
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>N°</td>
                                                <td>ID Lote</td>
                                                <td>Tipo Entrega</td>
                                                <td>Cantidad Gavetas</td>
                                                <td>Tipo Peso</td>
                                                <td>Peso Bruto</td>
                                                <td>Usuario</td>
                                                <td>Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($presas as $presa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $presa->entregas_id }}</td>
                                                    <td>{{ $presa->tipo_entrega }}</td>
                                                    <td>{{ $presa->cant_gavetas }}</td>
                                                    <td>{{ $presa->tipo_peso }}</td>
                                                    <td>{{ $presa->peso_bruto }}</td>
                                                    <td>{{ $presa->usuario }}</td>
                                                    <td>{{ $presa->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
