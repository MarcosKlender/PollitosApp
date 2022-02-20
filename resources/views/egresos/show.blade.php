@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>LOTE {{ $lote->id }} - {{ $lote->tipo }} - EGRESOS</h4>
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
                            <h6 class="font-weight-bold">GAVETAS VACÍAS<label id="nombre_gavetas"></label></h6>
                        </a>
                    </li>
                </ul>

                <div class="card-body">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pesos" role="tabpanel" aria-labelledby="pesos">

                            <div class="row justify-content-around">
                                <a href="{{ route('egresos.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
                            </div>

                            @if (count($egresos) != 0)
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>#</td>
                                                <td>ID Lote</td>
                                                <td>Cantidad de Gavetas</td>
                                                <td>Peso Bruto</td>
                                                {{-- <td>Peso Gavetas</td> --}}
                                                {{-- <td>Peso Final</td> --}}
                                                <td>Usuario creación</td>
                                                <td>Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($egresos as $egreso)
                                                <tr>
                                                    <td>{{ $egreso->id }}</td>
                                                    <td>{{ $egreso->lotes_id }}</td>
                                                    <td>{{ $egreso->cant_gavetas }}</td>
                                                    <td>{{ $egreso->peso_bruto }}</td>
                                                    {{-- <td>{{ $egreso->peso_gavetas }}</td> --}}
                                                    {{-- <td>{{ $egreso->peso_final }}</td> --}}
                                                    <td>{{ $egreso->usuario }}</td>
                                                    <td>{{ $egreso->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2"><b>TOTAL</b></td>
                                                <td><b>{{ $total_cantidad }}</b></td>
                                                <td><b>{{ $total_bruto }}</b></td>
                                                {{-- <td><b>{{ $total_gavetas }}</b></td> --}}
                                                {{-- <td><b>{{ $total_final }}</b></td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>

                        <div class="tab-pane fade" id="gavetas" role="tabpanel" aria-labelledby="gavetas">

                            <div class="row justify-content-around">
                                <a href="{{ route('egresos.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
                            </div>

                            @if (count($gavetas) != 0)
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>#</td>
                                                <td>ID Lote</td>
                                                <td>Cantidad Gavetas Vacías</td>
                                                <td>Peso Gavetas Vacías</td>
                                                {{-- <td>Tipo Peso</td> --}}
                                                <td>Usuario creacion</td>
                                                <td>Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gavetas as $gaveta)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $gaveta->lotes_id }}</td>
                                                    <td>{{ $gaveta->cant_gavetas_vacias }}</td>
                                                    <td>{{ $gaveta->peso_gavetas_vacias }}</td>
                                                    {{-- <td>{{ $gaveta->tipo_peso }}</td> --}}
                                                    <td>{{ $gaveta->usuario }}</td>
                                                    <td>{{ $gaveta->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2"><b>TOTAL</b></td>
                                                <td><b>{{ $cant_gav_vac }}</b></td>
                                                <td><b>{{ $peso_gav_vac }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td class="col-6">Total Gavetas Pesadas</td>
                                    <td class="col-6">Total Gavetas Vacías</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $total_cantidad }}</td>
                                    <td>{{ $cant_gav_vac }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td class="col-6">Total Peso Bruto</td>
                                    <td class="col-6">Total Peso Gavetas Vacías</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $total_bruto }}</td>
                                    <td>{{ $peso_gav_vac }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                        <!-- Cantidad de ahogados !-->
                        <div class="table-responsive mt-3">
                        <h5 class="card-header"> Animales ahogados</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td class="col-4">Cantidad ahogados</td>
                                    <td class="col-4">Peso ahogados</td>
                                    <td class="col-4">Cantidad gavetas vacías ahogados</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $lote->cant_ahogados_egresos }}</td>
                                    <td>{{ $lote->peso_ahogados_egresos }}</td>
                                    <td>{{ $lote->cant_gvacia_ahogados_egresos }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                     <!-- Cantidad de Estropeados !-->
                        <div class="table-responsive mt-3">
                        <h5 class="card-header"> Animales Estropeados</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td class="col-4">Cantidad estropeados</td>
                                    <td class="col-4">Peso estropeados</td>
                                     <td class="col-4">Cantidad gavetas vacías estropeados</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $lote->cant_estropeados_egresos }}</td>
                                    <td>{{ $lote->peso_estropeados_egresos }}</td>
                                     <td>{{ $lote->cant_gvacia_estropeados_egresos }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                     <!-- Cantidad de mollejas !-->
                        <div class="table-responsive mt-3">
                        <h5 class="card-header"> Mollejas</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="font-weight-bold">
                                    <!--td class="col-4">Cantidad mollejas</td!-->
                                    <td class="col-6">Peso mollejas</td>
                                    <td class="col-6">Cantidad gavetas vacias mollejas</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!--td>{{-- $lote->cant_mollejas_egresos --}}</td!-->
                                    <td>{{ $lote->peso_mollejas_egresos }}</td>
                                    <td>{{ $lote->cant_gvacia_mollejas_egresos }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
