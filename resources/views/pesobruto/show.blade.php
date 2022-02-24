@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4><b>INGRESOS | </b>  LOTE {{ $lote->id }} | {{ $lote->tipo }} | {{ $lote->proveedor }}</h4>
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
                                <a href="{{ route('pesobruto.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
                            </div>

                            @if (count($registros) != 0)
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
                                            @foreach ($registros as $registro)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $registro->lotes_id }}</td>
                                                    <td>{{ $registro->cant_gavetas }}</td>
                                                    <td>{{ $registro->peso_bruto }}</td>
                                                    {{-- <td>{{ $registro->peso_gavetas }}</td> --}}
                                                    {{-- <td>{{ $registro->peso_final }}</td> --}}
                                                    <td>{{ $registro->usuario_creacion }}</td>
                                                    <td>{{ $registro->updated_at }}</td>
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
                                <a href="{{ route('pesobruto.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
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
                                                <td>Usuario creación</td>
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
                                                    <td>{{ $gaveta->usuario_creacion }}</td>
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

                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td class="col-6">Cantidad animales ahogados</td>
                                    <td class="col-6">Peso animales ahogados</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $lote->cant_ahogados }}</td>
                                    <td>{{ $lote->peso_ahogados }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
