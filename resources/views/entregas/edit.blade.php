@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>ENTREGA {{ $entregas->id }} - {{ $entregas->tipo }}</h4>
                </div>

                <ul class="nav nav-tabs nav-fill" id="myTab1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pesos-tab" data-toggle="tab" href="#pesos" role="tab"
                            aria-controls="pesos" aria-selected="true">
                            <h6 class="font-weight-bold">REGISTRO DE PESOS<label id="nombre_pesos"></label></h6>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="gavetas-tab" data-toggle="tab" href="#gavetas" role="tab"
                            aria-controls="gavetas" aria-selected="false">
                            <h6 class="font-weight-bold">PRESAS A ENTREGAR<label id="nombre_gavetas"></label></h6>
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

                            <form method="post" action="{{ route('entregas.update', $entregas->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="cant_gavetas">Cantidad de Gavetas</label>
                                        @if( $valor_cant_gavetas > "0"  )
                                            <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                                value="{{ $valor_cant_gavetas }}" required readonly />
                                        @elseif( $valor_cant_gavetas == "0"  ||  $valor_cant_gavetas == null )
                                         <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                                value="{{ old('cant_gavetas') }}" required autofocus />
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="peso_bruto">Peso Bruto</label>
                                         @if ($e_automatico == '1' and $menu == 'ENTREGAS')
                                            <div id="recargar" name="recargar"></div>
                                         @elseif($e_automatico == '0' and $menu == 'ENTREGAS')
                                            <input type="number" class="form-control" id="peso_bruto" name="peso_bruto"
                                            value="{{ old('peso_bruto') }}" required  />
                                        @elseif($e_automatico == null)
                                             <input type="number" class="form-control" id="peso_bruto" name="peso_bruto"
                                                  step=".01" required readonly />
                                            @endif
                                    </div>

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
                                <input type="hidden" id="entregas_id" name="entregas_id" value="{{ $entregas->id }}"
                                    required />
                                <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->username }}"
                                    required />
                                <input type="hidden" id="anulado" name="anulado" value="0" required />
                                <div class="row justify-content-around mt-2">
                                    <a href="{{ route('entregas.index') }}" class="btn btn-primary">Volver Atrás</a>
                                    <button type="submit" class="btn btn-success">Registrar Peso</button>
                                </div>
                            </form>

                            @if (count($registros) != 0)
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped table-bordered" id="tabla_egresos">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td class="text-center">N°</td>
                                                <td class="text-center">Cantidad Gavetas</td>
                                                <td class="text-center">Peso Bruto</td>
                                                <td class="text-center">Tipo Peso</td>
                                                @if (Auth::user()->rol->key == 'admin')
                                                    <td class="text-center">Usuario</td>
                                                @endif
                                                <td class="text-center">Acciones</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registros as $registro)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $registro->cant_gavetas }}</td>
                                                    <td class="text-center">{{ $registro->peso_bruto }}</td>
                                                    <td class="text-center">{{ $registro->tipo_peso }}</td>
                                                    @if (Auth::user()->rol->key == 'admin')
                                                        <td class="text-center">{{ $registro->usuario }}</td>
                                                    @endif
                                                    <td class="text-center"><button type="button"
                                                            class="btn btn-sm btn-danger modal_anular" data-toggle="modal"
                                                            data-target="#staticBackdrop2"
                                                            data-id="{{ $registro->id }}"><i class="far fa-trash-alt fa-lg"></i></button>
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
                            @elseif(session()->get('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
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

                            <form method="post" action="{{ route('presas_entregas.update', $entregas->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="cant_gavetas">Tipo de Entrega</label>
                                        <select class="custom-select" id="tipo_entrega" name="tipo_entrega" required>
                                            <option value="" selected disabled>Elija un tipo de entrega</option>
                                            <option value="MENUDENCIA">MENUDENCIA</option>
                                            <option value="MOLLEJAS ABIERTAS">MOLLEJAS ABIERTAS</option>
                                            <option value="MOLLEJAS CERRADAS">MOLLEJAS CERRADAS</option>
                                            <option value="MOLLEJAS LIMPIAS">MOLLEJAS LIMPIAS</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="cant_gavetas">Cantidad de Gavetas</label>
                                        <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                            value="{{ old('cant_gavetas') }}" required autofocus />
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="peso_bruto">Peso Bruto</label>
                                        <input type="number" class="form-control" id="peso_bruto" name="peso_bruto"
                                            value="{{ old('peso_bruto') }}" required autofocus />
                                    </div>

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
                                <input type="hidden" id="entregas_id" name="entregas_id" value="{{ $entregas->id }}">
                                <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->username }}"
                                    required />
                                <input type="hidden" id="anulado" name="anulado" value="0" required />
                                <div class="row justify-content-around mt-2">
                                    <a href="{{ route('entregas.index') }}" class="btn btn-primary">Volver Atrás</a>
                                    <button type="submit" class="btn btn-success">Registrar Peso</button>
                                </div>
                            </form>

                            @if (count($presas) != 0)
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped table-bordered" id="tabla_egresos_gavetas">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td class="text-center">N°</td>
                                                <td class="text-center">Tipo de Entrega</td>
                                                <td class="text-center">Cantidad Gavetas</td>
                                                <td class="text-center">Peso Bruto</td>
                                                <td class="text-center">Tipo Peso</td>
                                                @if (Auth::user()->rol->key == 'admin')
                                                    <td class="text-center">Usuario</td>
                                                @endif
                                                <td class="text-center">Acciones</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($presas as $presa)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $presa->tipo_entrega }}</td>
                                                    <td class="text-center">{{ $presa->cant_gavetas }}</td>
                                                    <td class="text-center">{{ $presa->peso_bruto }}</td>
                                                    <td class="text-center">{{ $presa->tipo_peso }}</td>
                                                    @if (Auth::user()->rol->key == 'admin')
                                                        <td class="text-center">{{ $presa->usuario }}</td>
                                                    @endif
                                                    <td class="text-center"><button type="button"
                                                            class="btn btn-sm btn-danger modal_anular_gavetas"
                                                            data-toggle="modal" data-target="#staticBackdrop4"
                                                            data-id="{{ $presa->id }}"><i class="far fa-trash-alt fa-lg"></i></button>
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
                            id="liquidar" name="liquidar">Liquidar Entrega</button>
                    </div>

                </div>
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

                    <form action="{{ route('entregas.anular_registro') }}" method="post">
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
                    <h5 class="modal-title" id="staticBackdropLabel3">¿Está seguro de liquidar la entrega?</h5>
                </div>
                <form action="{{ route('entregas.liquidar_lote') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cant_animales">Cantidad Animales</label>
                            <input type="number" class="form-control" id="cant_animales" name="cant_animales"
                                        value="{{ old('cant_animales') }}" required />
                        </div>
                          Una vez liquidada la entrega no podrá registrar más pesos. </br> </br>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" id="id_liquidar" name="id_liquidar" value="{{ $entregas->id }}">
                        <input type="hidden" id="liquidado" name="liquidado" value="1">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Liquidar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para PRESAS A ENTREGAR -->
    <div class="modal fade" id="staticBackdrop4" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel4" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel4"></h5>
                </div>
                <div class="modal-body">
                    Esta acción no se puede deshacer. <br><br>

                    <form action="{{ route('presas_entregas.anular') }}" method="post">
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
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

            var tbl_egresos = $("#tabla_egresos").length;
            var tbl_egresos_vacia = $("#tabla_egresos_gavetas").length;

            if (tbl_egresos === 0) {
                $("#liquidar").prop('disabled', true);
            }

            $("#liquidar").click(function() {
                $(".modal-title").html('¿Está seguro de liquidar la entrega?');
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
                $('#recargar').load('/entregas/seccion_entregas');
            }, 2000);
        });
    </script>

@endsection
