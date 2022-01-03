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

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pesos" role="tabpanel" aria-labelledby="pesos">

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

                            <form method="post" action="{{ route('egresos.update', $lote->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="cant_gavetas">Cantidad de Gavetas</label>
                                        <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                            value="{{ old('cant_gavetas') }}" required autofocus />
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="peso_bruto">Peso Bruto</label>

                                        @if ($e_automatico)
                                            <div id="recargar" name="recargar"></div>
                                        @else
                                            <input type="number" class="form-control" id="peso_bruto" name="peso_bruto"
                                                value="{{ old('peso_bruto') }}" step=".01" required />
                                        @endif

                                    </div>

                                    <!--div class="form-group col-lg-6">
                                                        <label for="peso_bruto">Peso Bruto</label>
                                                        <input type="number" class="form-control" id="peso_bruto" name="peso_bruto"
                                                            value="{{ old('peso_bruto') }}" step=".01" required />
                                                    </div!-->

                                    <div class="form-group col-lg-12 text-center">
                                        <label for="tipo_peso" class="mr-5">Tipo de Peso:</label>
                                        @if ($tipo_peso == 'lb')
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_peso" id="tipo_peso"
                                                    value="lb" checked>
                                                <label class="form-check-label" for="libras">Libras</label>
                                            </div>
                                        @elseif($tipo_peso == 'kg')
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_peso" id="tipo_peso"
                                                    value="kg">
                                                <label class="form-check-label" for="kilogramos">Kilogramos</label>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <input type="hidden" id="peso_gavetas_cero" name="peso_gavetas" value="0">
                                <input type="hidden" id="peso_final_cero" name="peso_final" value="0">
                                <input type="hidden" id="lotes_id" name="lotes_id" value="{{ $lote->id }}" required />
                                <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->username }}"
                                    required />
                                <input type="hidden" id="anulado" name="anulado" value="0" required />
                                <div class="row justify-content-around mt-2">
                                    <a href="{{ route('egresos.index') }}" class="btn btn-primary">Volver Atrás</a>
                                    <button type="submit" class="btn btn-success">Registrar Peso</button>
                                </div>
                            </form>

                            @if (count($egresos) != 0)
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped table-bordered" id="tabla_egresos">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>#</td>
                                                {{-- <td>ID Lote</td> --}}
                                                <td>Cantidad Gavetas</td>
                                                <td>Peso Bruto</td>
                                                {{-- <td>Peso Gavetas</td> --}}
                                                {{-- <td>Peso Final</td> --}}
                                                <td>Tipo Peso</td>
                                                @if (Auth::user()->rol->key == 'admin')
                                                    <td>Usuario</td>
                                                @endif
                                                <td colspan="2" class="text-center">Acciones</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($egresos as $egreso)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    {{-- <td>{{ $egreso->lotes_id }}</td> --}}
                                                    <td>{{ $egreso->cant_gavetas }}</td>
                                                    <td>{{ $egreso->peso_bruto }}</td>
                                                    {{-- <td>{{ $egreso->peso_gavetas }}</td> --}}
                                                    {{-- <td>{{ $egreso->peso_final }}</td> --}}
                                                    <td>{{ $egreso->tipo_peso }}</td>
                                                    @if (Auth::user()->rol->key == 'admin')
                                                        <td>{{ $egreso->usuario }}</td>
                                                    @endif
                                                    {{-- <td class="text-center"><button type="button"
                                                            class="btn btn-sm btn-primary modal_gavetas" data-toggle="modal"
                                                            data-target="#staticBackdrop1" data-id="{{ $egreso->id }}"
                                                            data-cant-gavetas="{{ $egreso->cant_gavetas }}"
                                                            data-peso-bruto="{{ $egreso->peso_bruto }}">Gavetas</button>
                                                    </td> --}}
                                                    <td class="text-center"><button type="button"
                                                            class="btn btn-sm btn-danger modal_anular" data-toggle="modal"
                                                            data-target="#staticBackdrop2"
                                                            data-id="{{ $egreso->id }}">Anular</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="tab-pane fade" id="gavetas" role="tabpanel" aria-labelledby="gavetas">

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

                            <form method="post" action="{{ route('gavetas_vacias_egresos.update', $lote->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="cant_gavetas_vacias">Cantidad de Gavetas Vacías</label>
                                        <input type="number" class="form-control" id="cant_gavetas_vacias"
                                            name="cant_gavetas_vacias" value="{{ old('cant_gavetas_vacias') }}"
                                            required />
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="peso_gavetas_vacias">Peso de Gavetas Vacías</label>
                                        @if ($e_automatico)
                                            <div id="recargar" name="recargar"></div>
                                        @else
                                            <input type="number" class="form-control" id="peso_gavetas_vacias"
                                                name="peso_gavetas_vacias" value="{{ old('peso_gavetas_vacias') }}"
                                                step=".01" required />
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-12 text-center">
                                        <label for="tipo_peso" class="mr-5">Tipo de Peso:</label>
                                        @if ($tipo_peso == 'lb')
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="tipo_peso" name="tipo_peso"
                                                    value="lb" checked>
                                                <label class="form-check-label" for="libras">Libras</label>
                                            </div>
                                        @elseif($tipo_peso == 'kg')
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="tipo_peso" name="tipo_peso"
                                                    value="kg" checked="">
                                                <label class="form-check-label" for="kilogramos">Kilogramos</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" id="lotes_id" name="lotes_id" value="{{ $lote->id }}">
                                <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->username }}"
                                    required />
                                <input type="hidden" id="anulado" name="anulado" value="0" required />

                                <div class="row justify-content-around mt-2">
                                    <a href="{{ route('egresos.index') }}" class="btn btn-primary">Volver Atrás</a>
                                    <button type="submit" class="btn btn-success">Registrar Peso</button>
                                </div>
                            </form>

                            @if (count($gavetas) != 0)
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped table-bordered" id="tabla_pesobruto_gavetas">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>#</td>
                                                <td>Cantidad Gavetas Vacías</td>
                                                <td>Peso Gavetas Vacías</td>
                                                <td>Tipo Peso</td>
                                                @if (Auth::user()->rol->key == 'admin')
                                                    <td>Usuario</td>
                                                @endif
                                                <td class="text-center">Acciones</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gavetas as $gaveta)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $gaveta->cant_gavetas_vacias }}</td>
                                                    <td>{{ $gaveta->peso_gavetas_vacias }}</td>
                                                    <td>{{ $gaveta->tipo_peso }}</td>
                                                    @if (Auth::user()->rol->key == 'admin')
                                                        <td>{{ $gaveta->usuario }}</td>
                                                    @endif
                                                    <td class="text-center"><button type="button"
                                                            class="btn btn-sm btn-danger modal_anular_gavetas"
                                                            data-toggle="modal" data-target="#staticBackdrop4"
                                                            data-id="{{ $gaveta->id }}">Anular</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop3"
                            id="liquidar" name="liquidar">Liquidar Lote</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para GAVETAS -->
    <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel1"></h5>
                </div>

                <form action="{{ route('egresos.registrar_gavetas') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="number" class="form-control" id="peso_gavetas" name="peso_gavetas" step=".01"
                            placeholder="Ingrese PESO" required />
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_gavetas" name="id_gavetas">
                        <input type="hidden" id="peso_final" name="peso_final">
                        <button type="button" id="cancelar_gavetas" class="btn btn-primary"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="submit_gavetas" class="btn btn-success">Registrar Peso</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal para ANULAR -->
    <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel2"></h5>
                </div>
                <div class="modal-body">
                    Esta acción no se puede deshacer. <br><br>

                    <form action="{{ route('egresos.anular_registro') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Razones de la Anulación</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"
                                required></textarea>
                        </div>
                        <input type="hidden" id="id_anular" name="id_anular">
                        <input type="hidden" id="anulado" name="anulado" value="1">
                        <button type="button" id="cancelar_anular" class="btn btn-primary"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Anular</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para LIQUIDAR -->
    <div class="modal fade" id="staticBackdrop3" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel3">¿Está seguro de liquidar el lote?</h5>
                </div>
                <form action="{{ route('egresos.liquidar_lote') }}" method="post">
                    <div class="modal-body">

                        @if ($cant_gav < $cant_gav_vac)
                        <div class="alert alert-danger" role="alert">
                            La cantidad de gavetas vacías ({{ $cant_gav_vac }}) es mayor a la cantidad de gavetas
                            registradas ({{ $cant_gav }}), corrija esto antes de liquidar este lote.
                        </div>
                    @else
                        Una vez liquidado el lote no podrá registrar más pesos.
                    @endif

                    </div>
                    <div class="modal-footer">
                        @csrf
                        <input type="hidden" id="id_liquidar" name="id_liquidar" value="{{ $lote->id }}">
                        <input type="hidden" id="egresos" name="egresos" value="1">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Liquidar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para GAVETAS VACÍAS -->
    <div class="modal fade" id="staticBackdrop4" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel4" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel4"></h5>
                </div>
                <div class="modal-body">
                    Esta acción no se puede deshacer. <br><br>

                    <form action="{{ route('gavetas_vacias_egresos.anular') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Razones de la Anulación</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"
                                required></textarea>
                        </div>
                        <input type="hidden" id="id_anular_gavetas" name="id_anular_gavetas">
                        <input type="hidden" id="anulado" name="anulado" value="1">
                        <button type="button" id="cancelar_anular" class="btn btn-primary"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Anular</button>
                    </form>
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

            if (usedTab == "gavetas") {
                $("#gavetas").show();
                $("#cant_gavetas_vacias").focus();
            }

            var ac_cant_gaveta = 0,
                ac_cant_gaveta_vacia = 0;

            // var tbl_peso_bruto = $("#tabla_pesobruto").length;
            // var tbl_gabeta_vacia = $("#tabla_pesobruto_gavetas").length;

            // if (tbl_peso_bruto === 0 || tbl_gabeta_vacia === 0) {
            //     $("#liquidar").prop('disabled', true);
            // }

            var columna = $("#tabla_egresos td:nth-child(6)").map(function() {
                return $(this).text();
            }).get();
            if (jQuery.inArray('0.00', columna) != -1 || $("table").length == 0) {
                $("#liquidar").prop('disabled', true);
            }

            $("#liquidar").click(function() {
                $(".modal-title").html('¿Está seguro de liquidar el lote?');
            });

            $(".modal_gavetas").click(function() {
                $("#staticBackdrop1").on('shown.bs.modal', function() {
                    $(this).find('#peso_gavetas').focus();
                });

                var registro_g = $(this).attr('data-id');
                var cantidad_g = $(this).attr('data-cant-gavetas');
                $(".modal-title").html('REGISTRO #' + registro_g + ' - CANTIDAD DE GAVETAS: ' + cantidad_g);
                $("#id_gavetas").val(registro_g);
                var peso_bruto = parseFloat($(this).attr('data-peso-bruto')).toFixed(2);

                $("#submit_gavetas").click(function() {
                    var peso_gavetas = parseFloat($("#peso_gavetas").val()).toFixed(2);
                    var peso_final = parseFloat(peso_bruto - peso_gavetas).toFixed(2);
                    $("#peso_final").val(peso_final);
                });

                $("#cancelar_gavetas").click(function() {
                    $("#peso_gavetas").val("");
                });
            });

            $(".modal_anular").click(function() {
                var registro_a = $(this).attr('data-id');
                $(".modal-title").html('¿Está seguro de anular el registro #' + registro_a + '?');
                $("#id_anular").val(registro_a);

                $("#cancelar_anular").click(function() {
                    $("#observaciones").val("");
                });
            });

            $(".modal_anular_gavetas").click(function() {
                var registro_gv = $(this).attr('data-id');
                $(".modal-title").html('¿Está seguro de anular el registro #' + registro_gv + '?');
                $("#id_anular_gavetas").val(registro_gv);

                $("#cancelar_anular").click(function() {
                    $("#observaciones").val("");
                });
            });
        });

        $(document).ready(function() {
            setInterval(function() {
                $('#recargar').load('/egresos/seccion');
            }, 2000);
        });
    </script>

@endsection
