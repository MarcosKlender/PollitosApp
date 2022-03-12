@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">

                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>REPORTES ENTREGAS</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <form method="get" action="{{ route('reportesentregas.show', 'search') }}">
                                <div class="input-group">

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_identrega" name="criterio_identrega" class="form-control"
                                            placeholder="Buscar codigo entrega">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_tipo" name="criterio_tipo" class="form-control"
                                            placeholder="Buscar tipo">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_ruc_ci" name="criterio_ruc_ci"
                                            class="form-control" placeholder="Buscar identificacion">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_cliente" name="criterio_cliente"
                                            class="form-control" placeholder="Buscar cliente">
                                    </div>


                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_conductor" name="criterio_conductor"
                                            class="form-control" placeholder="Buscar conductor">
                                    </div>

                                    <div class="input-group-append col-auto input-group-append">
                                        <input type="search" id="criterio_usuario" name="criterio_usuario"
                                            class="form-control" placeholder="Buscar usuario">
                                    </div>

                                </div>
                                <br>
                                <div class="input-group">

                                    <div class="input-group-append col-auto input-group-append">
                                        <label for="fecha_ini" class="col-auto col-form-label"> Desde: </label>
                                        <input type="date" class="form-control" name="criterio_fecha_ini">
                                    </div>

                                    <div class="input-group-append col-auto input-group-append">
                                        <label for="fecha_fin" class="col-auto col-form-label"> Hasta: </label>
                                        <input type="date" class="form-control" name="criterio_fecha_fin">
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="criterio_anulado" value="1"
                                            name="criterio_anulado">
                                        <label class="form-check-label" for="inlineCheckbox1"> Anulado </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="criterio_liquidado" value="1"
                                            name="criterio_liquidado">
                                        <label class="form-check-label" for="inlineCheckbox2"> Liquidado </label>
                                    </div>

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary border" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($count == 0)
                        <div class="alert alert-danger">No se han encontrado entregas.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="reportes_peso">
                                <thead class="table-secondary">
                                    <tr class="font-weight-bold">
                                        <td align="center">N°</td>
                                        <td align="center">Tipo</td>
                                        <td align="center">CI / RUC</td>
                                        <td align="center">Clientes</td>
                                        <td align="center">Placa</td>
                                        <td align="center">Conductor</td>
                                        <td align="center">Destino</td>
                                        <td align="center">Cantidad Total Animal</td>
                                        <td align="center">Tot. Cant. Gavetas</td>
                                        <td align="center">Tot. Peso Bruto</td>
                                        <td align="center">Usuario</td>
                                        <td align="center">Fecha creación</td>
                                        <td align="center">Anulado</td>
                                        <td align="center">Liquidado</td>
                                        <td align="center">Reporte pdf</td>
                                        <td align="center">Reporte excel</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entregas as $entrega)
                                        <tr>
                                            <td align="center" class="numero_id" id="{{ $entrega->id }}">{{ $entrega->id }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->tipo }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->ruc_ci }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->cliente }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->placa }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->conductor }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->destino }}</td>                                            
                                            <td align="center" class="row_peso">{{ $entrega->cant_animales }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->total_cant_gavetas }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->total_peso_bruto }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->usuario }}</td>
                                            <td align="center" class="row_peso">{{ $entrega->created_at }}</td>
                                            <td align="center" class="button">
                                                @if ($entrega->anulado == '0')
                                                    <button id="btn_prueba" class="btn btn-sm btn-primary"
                                                        type="submit">NO</button>
                                                @else
                                                    <button class="btn btn-sm btn-danger" type="submit">SI</button>
                                                @endif
                                            </td>

                                            <td align="center" class="button">
                                                @if ($entrega->liquidado == '0')
                                                    <button type="button" class="btn btn-sm btn-danger">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-warning">SI</button>
                                                @endif
                                            </td>
                                            <td align="center" class="button">
                                                <a href="{{ route('reportesentregas.generar_pdf', $entrega->id) }}" target="_blank"
                                                    class="btn btn-lg btn-primary"><i class="far fa-file-pdf"></i></a>
                                            </td>
                                            <td align="center" class="button">
                                                <a href="{{ route('reportesentregas.generar_excel_entrega', $entrega->id) }}"
                                                    target="_blank" class="btn btn-lg btn-primary"><i
                                                        class="far fa-file-excel"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $entregas->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span> --}}
                    </div>
                    <br>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#lote" role="tab"
                                aria-controls="lote" aria-selected="true">
                                <h6>REGISTROS PESOS # <label id="nombre_entrega"></label></h6>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#egresos" role="tab"
                                aria-controls="egresos" aria-selected="false">
                                <h6>REGISTRO PRESAS <label id="peso_neto"></label></h6>
                            </a>
                        </li>
                    </ul>                    

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="lote" role="tabpanel" aria-labelledby="lote">
                        <!-- Registros de pesos !-->
                        <div class="row">  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-secondary">
                                            <tr class="font-weight-bold">
                                                <td align="center">N°</td>
                                                <td align="center">Cantidad Gavetas</td>
                                                <td align="center">Peso Bruto</td>
                                                <td align="center">Tipo Peso</td>
                                                <td align="center">Estado</td>
                                                <td align="center">Observación</td>
                                                <td align="center">Usuario</td>
                                                <td align="center">Fecha creación</td>
                                            </tr>
                                        </thead>
                                        <!--tbody!-->
                                        <tbody id="cuerpo_entrega">
                                        </tbody>
                                        <tr class="font-weight-bold">
                                            <td align="center" colspan="1"><b>TOTAL</b></td>
                                            <td align="center" id="total_cantidad"><b></b></td>
                                            <td align="center" id="total_bruto"><b></b></td>
                                        </tr>
                                    </table>
                                </div>
                        </div>
                        </div>


                        <div class="tab-pane fade" id="egresos" role="tabpanel" aria-labelledby="egresos">
                        <div class="row">  
                            <!-- Registro presas !-->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class="table-secondary">
                                                <tr class="font-weight-bold">
                                                    <td align="center">N°</td>
                                                    <td align="center">Tipos Entregas</td>
                                                    <td align="center">Cantidad Gavetas</td>
                                                    <td align="center">Peso Neto</td>
                                                    <td align="center">Tipo Peso</td>
                                                    <td align="center">Estado</td>
                                                    <td align="center">Observación</td>
                                                    <td align="center">Usuario</td>
                                                    <td align="center">Fecha creación</td>
                                                </tr>
                                            </thead>
                                            <!--tbody!-->
                                            <tbody id="cuerpo_presa">
                                            </tbody>
                                            <tr class="font-weight-bold">
                                                <td align="center" colspan="2"><b>TOTAL</b></td>
                                                <td align="center" id="total_cantidad_presas"><b></b></td>
                                                <td align="center" id="total_bruto_presas"><b></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                 </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".row_peso").on('click', function(e) {
                // $("#reportes_peso tbody tr").click(function(e){


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                // var id=$(this).find("td:first-child").html(); 

                id = "";
                $(this).parents("tr").find(".numero_id").each(function() {
                    id += $(this).html() + "\n";
                });

                var tc = 0;
                var tb = 0;
                var tcgv = 0;
                var tpgv = 0;
                var id_acum = 0;
                var id_acumgv= 0;

                $('#nombre_entrega').text(id);

                $.ajax({
                    data: {
                        id: id
                    },
                    url: '/reportesentregas/detalle_entrega',
                    type: 'post',
                    success: function(response) {
                        $("#cuerpo_entrega").html("");
                        $.each(response, function(index, value) {
                            var fech = new Date(value.created_at);
                            var fecha = fech.toLocaleString();
                            $("#cuerpo_entrega").append(
                                $('<tr>'),
                                $('<td align="center">').text(id_acum=id_acum+1),
                                $('<td align="center">').text(value.cant_gavetas),
                                $('<td align="center">').text(value.peso_bruto),
                                $('<td align="center">').text(value.tipo_peso),
                                (value.anulado === '1') ? $('<td>').text(
                                    'Anulado') :
                                $('<td align="center">').text(''),
                                $('<td align="center">').text(value.observaciones),
                                $('<td align="center">').text(value.usuario),
                                $('<td align="center">').text(fecha),
                                $('</tr>'));
                            if (value.anulado === '0') {
                                tc = tc + parseFloat(value.cant_gavetas);
                                tb = tb + parseFloat(value.peso_bruto);
                            }
                        })
                        $('#total_cantidad').text(tc);
                        $('#total_bruto').text(tb);
                    },

                    statusCode: {
                        404: function() {
                            alert('web no encontrada');
                        }
                    },
                    error: function(response) {
                        alert(response);
                    }

                });



                  $.ajax({
                    data: {
                        id: id
                    },
                    url: '/reportesentregas/detalle_presas',
                    type: 'post',
                    //dataType:'json',
                    success: function(response) {
                        $("#cuerpo_presa").html("");
                        $.each(response, function(index, value) {
                            var fech = new Date(value.created_at);
                            var fecha = fech.toLocaleString();
                            $("#cuerpo_presa").append(
                                $('<tr>'),
                                $('<td align="center">').text(id_acumgv=id_acumgv+1),
                                $('<td align="center">').text(value.tipo_entrega),
                                $('<td align="center">').text(value.cant_gavetas),
                                $('<td align="center">').text(value.peso_bruto),
                                $('<td align="center">').text(value.tipo_peso),
                                (value.anulado === '1') ? $('<td>').text(
                                    'Anulado') :
                                $('<td align="center">').text(''),
                                $('<td align="center">').text(value.observaciones),
                                $('<td align="center">').text(value.usuario),
                                $('<td align="center">').text(fecha),
                                $('</tr>'));
                            if (value.anulado === '0') {
                                tcgv = tcgv + parseFloat(value.cant_gavetas);
                                tpgv = tpgv + parseFloat(value.peso_bruto);
                            }
                        })
                        $('#total_cantidad_presas').text(tcgv);
                        $('#total_bruto_presas').text(tpgv);
                    },

                    statusCode: {
                        404: function() {
                            alert('web no encontrada');
                        }
                    },
                    error: function(response) {
                        alert(response);
                    }
                });



            });
        });
    </script>

@endsection
