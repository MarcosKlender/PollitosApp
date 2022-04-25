@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<div class="row justify-content-center">
    <div class="col-lg-11">
        <div class="card shadow mb-4">
            <div class="card-header mt-2">
                <div class="text-center">
                    <h4>LOTES LIQUIDADOS</h4>
                </div>
            </div>

            <div class="card-body">

                @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @elseif( session()->get('error_anular'))
                <div class="alert alert-danger">
                    {{ session()->get('error_anular') }}
                </div>
                @endif

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="true">INGRESOS</a>

                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                            aria-controls="nav-profile" aria-selected="false">EGRESOS</a>

                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                            aria-controls="nav-contact" aria-selected="false">ENTREGAS</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @if ($count_ingresos == 0)
                        <div class="alert alert-danger">
                            No se han encontrado lotes.
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>Lote N°</td>
                                        <td>Tipo</td>
                                        <td>Cantidad Animales</td>
                                        <td>Proveedor</td>
                                        <td>RUC/CI</td>
                                        <td>Procedencia</td>
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                        <td>Usuario creación</td>
                                        <td>Fecha creación</td>
                                        <td>Liquidado</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote)
                                    <tr>
                                        <td>{{ $lote->id }}</td>
                                        <td>{{ $lote->tipo }}</td>
                                        <td>{{ $lote->cantidad }}</td>
                                        <td>{{ $lote->proveedor }}</td>
                                        <td>{{ $lote->ruc_ci }}</td>
                                        <td>{{ $lote->procedencia }}</td>
                                        <td>{{ $lote->placa }}</td>
                                        <td>{{ $lote->conductor }}</td>
                                        <td>{{ $lote->usuario_creacion }}</td>
                                        <td>{{ $lote->created_at }}</td>
                                        <td align="center">
                                            @if ($lote->liquidado == '0')
                                            <form method="post" action="{{ route('liquidados.update', $lote->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="liquidado" name="liquidado" value="1">
                                                <button type="submit" class="btn btn-sm btn-primary">NO</button>
                                            </form>
                                            @else
                                            <form method="post" action="{{ route('liquidados.update', $lote->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="liquidado" name="liquidado" value="0">
                                                <button type="submit" class="btn btn-sm btn-success">SI</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        <div class="row justify-content-around">
                            {{ $lotes->links() }}
                            {{-- <span>Total de Lotes:
                                <b>{{ $count_ingresos }}</b></span> --}}
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @if ($count_ingresos == 0)
                        <div class="alert alert-danger">No se han encontrado lotes.</div>
                        @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>Lote N°</td>
                                        <td>Tipo</td>
                                        <td>Cantidad animales</td>
                                        <td>Cantidad animales faenados</td>
                                        <td>Proveedor</td>
                                        <td>RUC/CI</td>
                                        <td>Usuario creación</td>
                                        <td>Fecha creación</td>
                                        <td>Liquidado</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote)
                                    <tr>
                                        <td>{{ $lote->id }}</td>
                                        <td>{{ $lote->tipo }}</td>
                                        <td>{{ $lote->cantidad }}</td>
                                        <td>{{ $lote->cant_animales_egresos }}</td>
                                        <td>{{ $lote->proveedor }}</td>
                                        <td>{{ $lote->ruc_ci }}</td>
                                        <td>{{ $lote->usuario_creacion }}</td>
                                        <td>{{ $lote->created_at }}</td>
                                        <td align="center">
                                            @if ($lote->estado_egresos == '0')
                                            <form method="post" action="{{ route('liquidados.update2', $lote->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="estado_egresos" name="estado_egresos"
                                                    value="1">
                                                <button type="submit" class="btn btn-sm btn-primary">NO</button>
                                            </form>
                                            @else
                                            <form method="post" action="{{ route('liquidados.update2', $lote->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="estado_egresos" name="estado_egresos"
                                                    value="0">
                                                <button type="submit" class="btn btn-sm btn-success">SI</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @endif

                        <div class="row justify-content-around">
                            {{ $lotes->links() }}
                            {{-- <span>Total de Lotes:
                                <b>{{ $count_ingresos }}</b></span> --}}
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        @if ($count_entregas == 0)
                        <div class="alert alert-danger">No se han encontrado entregas.</div>
                        @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>N°</td>
                                        <td>Tipo Animal</td>
                                        <td>RUC/CI</td>
                                        <td>Cliente</td>
                                        <td>Cantidad Animales</td>
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                        <td>Destino</td>
                                        <td>Para local</td>
                                        <td>Usuario creación</td>
                                        <td>Fecha creación</td>
                                        <td>Liquidado</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entregas as $entrega)
                                    <tr>
                                        <td>{{ $entrega->id}}</td>
                                        <td>{{ $entrega->tipo }}</td>
                                        <td>{{ $entrega->ruc_ci }}</td>
                                        <td>{{ $entrega->cliente }}</td>
                                        <td>{{ $entrega->cant_animales }}</td>
                                        <td>{{ $entrega->placa }}</td>
                                        <td>{{ $entrega->conductor }}</td>
                                        <td>{{ $entrega->destino }}</td>
                                        <td>
                                            @if ($entrega->tipo_entrega == '1')
                                            SI
                                            @else
                                            NO
                                            @endif
                                        </td>
                                        <td>{{ $entrega->usuario_creacion }}</td>
                                        <td>{{ $entrega->created_at }}</td>
                                        <td align="center">
                                            @if ($entrega->liquidado == '0')
                                            <form method="post"
                                                action="{{ route('liquidados.update3', $entrega->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="liquidado" name="liquidado" value="1">
                                                <button type="submit" class="btn btn-sm btn-primary">NO</button>
                                            </form>
                                            @else
                                            <form method="post"
                                                action="{{ route('liquidados.update3', $entrega->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="liquidado" name="liquidado" value="0">
                                                <button type="submit" class="btn btn-sm btn-success">SI</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @endif

                        <div class="row justify-content-around">
                            {{ $entregas->links() }}
                            {{-- <span>Total de Usuarios: <b>{{ $count_entregas }}</b></span> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var usedTab = '{{ Session::get('usedTab') }}';

        function activeTab(tab) {
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        };

        activeTab(usedTab);
    });
</script>

@endsection