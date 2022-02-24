@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4> {{ $entregas->id }} - {{ $entregas->tipo }} - ENTREGAS</h4>
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
                                <a href="{{ route('entregas.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
                            </div>

                            @if (count($registros) != 0)
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>N°</td>
                                                <td>Cantidad de Gavetas</td>
                                                <td>Peso Neto</td>
                                                <td>Tipo Peso</td>
                                                <td>Usuario creación</td>
                                                <td>Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registros as $registro)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $registro->cant_gavetas }}</td>                                                    
                                                    <td>{{ $registro->peso_bruto }}</td>
                                                    <td>{{ $registro->tipo_peso }}</td>
                                                    <td>{{ $registro->usuario_creacion }}</td>
                                                    <td>{{ $registro->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                             <tr>
                                                <td colspan="1"><b>TOTAL</b></td>
                                                <td><b>{{ $total_gavetas }}</b></td>
                                                <td><b>{{ $total_pneto }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>

                        <div class="tab-pane fade" id="gavetas" role="tabpanel" aria-labelledby="gavetas">

                            <div class="row justify-content-around">
                                <a href="{{ route('entregas.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
                            </div>

                            @if (count($presas) != 0)
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>N°</td>
                                                <td>Tipo Entrega</td>
                                                <td>Cantidad Gavetas</td>
                                                <td>Peso Bruto</td>
                                                <td>Tipo Peso</td>
                                                <td>Usuario creación</td>
                                                <td>Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($presas as $presa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $presa->tipo_entrega }}</td>
                                                    <td>{{ $presa->cant_gavetas }}</td>
                                                    <td>{{ $presa->peso_bruto }}</td>
                                                    <td>{{ $presa->tipo_peso }}</td>
                                                    <td>{{ $presa->usuario_creacion }}</td>
                                                    <td>{{ $presa->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                <td colspan="2"><b>TOTAL</b></td>
                                                <td><b>{{ $total_presa_gavetas }}</b></td>
                                                <td><b>{{ $total_presa_pneto }}</b></td>
                                            </tr>
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
