@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">

                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>REPORTES INGRESOS Y EGRESOS</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <form method="get" action="{{ route('reportes.show', 'search') }}">
                                <div class="input-group">

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_lote" name="criterio_lote" class="form-control"
                                            placeholder="Buscar lote">
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
                                        <input type="search" id="criterio_proveedor" name="criterio_proveedor"
                                            class="form-control" placeholder="Buscar proveedor">
                                    </div>


                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_procedencia" name="criterio_procedencia"
                                            class="form-control" placeholder="Buscar procedencia">
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_placa" name="criterio_placa"
                                            class="form-control" placeholder="Buscar placa">
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

                                    <div class="col"></div>

                                     <div  id="excel-consolidado" class=" form-check-inline">
                                       {{-- @foreach ($lotes as $lote) --}}
                                        {{-- <a href="{{ route('reportes.generar_excel_consolidado', $lote->id) }}" target="_blank" class="btn btn-lg btn-info"><i class="far fa-file-excel "></i></a> --}}
                                       {{-- @endforeach --}}                    
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
                        <div class="alert alert-danger">No se han encontrado lotes.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="reportes_peso">
                                <thead class="table-secondary">
                                    <tr class="font-weight-bold">
                                        <td align="center">N° Lote</td>
                                        <td align="center">Tipo</td>
                                        <td align="center">CI/RUC</td>
                                        <td align="center">Proveedor</td>
                                        <td align="center">Procedencia</td>
                                        <td align="center">Placa</td>
                                        <td align="center">Conductor</td>
                                        <td align="center">Cantidad animales (Ingresos)</td>
                                        <td align="center">Cantidad animales (Egresos)</td>
                                        <td align="center">Tot. Cant. Gavetas</td>
                                        <td align="center">Cantidad Animal Ahogado</td>
                                        <td align="center">Peso Animal Ahogado</td>
                                        <td align="center">Tot. Peso Bruto</td>
                                        {{-- <td align="center">Tot. Peso Gavetas Vacías</td> --}}
                                        <td align="center">Usuario creación</td>
                                        <td align="center">Fecha creación</td>
                                        <td align="center">Anulado</td>
                                        <td align="center">Liquidado ingreso</td>
                                        <td align="center">Liquidado egreso</td>
                                        <td align="center">Reporte pdf</td>
                                        <td align="center">Reporte excel</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote)
                                        <tr>
                                            <td align="center" class="numero_id" id="{{ $lote->id }}">{{ $lote->id }}</td>
                                            <td align="center" class="row_peso">{{ $lote->tipo }}</td>
                                            <td align="center" class="row_peso">{{ $lote->ruc_ci }}</td>
                                            <td align="center" class="row_peso">{{ $lote->proveedor }}</td>
                                            <td align="center" class="row_peso">{{ $lote->procedencia }}</td>
                                            <td align="center" class="row_peso">{{ $lote->placa }}</td>
                                            <td align="center" class="row_peso">{{ $lote->conductor }}</td>
                                            <td align="center" class="row_peso">{{ $lote->cantidad }}</td>
                                            <td align="center" class="row_peso">{{ $lote->cant_animales_egresos }}</td>
                                            <td align="center" class="row_peso">{{ $lote->total_cant_gavetas }}</td>
                                            <td align="center" class="row_peso">{{ $lote->cant_ahogados }}</td>
                                            <td align="center" class="row_peso">{{ $lote->peso_ahogados }}</td>
                                            <td align="center" class="row_peso">{{ $lote->total_peso_bruto }}</td>
                                            {{-- @foreach ($gavetas_vacias as $gaveta_v) --}}                         
                                            {{--   @if( $lote->id == $gaveta_v->id ) --}}
                                            {{-- <td align="center" class="row_peso"> --}}
                                                {{-- $gaveta_v->total_peso_gavetas_vacias --}}
                                            {{-- </td> --}}                                            
                                            {{-- @endif --}}
                                            {{-- @endforeach --}}   
                                            <td align="center" class="row_peso">{{ $lote->usuario_creacion }}</td>
                                            <td align="center" class="row_peso">{{ $lote->created_at }}</td>
                                            <td align="center" class="button">
                                                @if ($lote->anulado == '0')
                                                    <button id="btn_prueba" class="btn btn-sm btn-primary"
                                                        type="submit">NO</button>
                                                @else
                                                    <button class="btn btn-sm btn-danger" type="submit">SI</button>
                                                @endif
                                            </td>

                                            <td align="center" class="button">
                                                @if ($lote->liquidado == '0')
                                                    <button type="button" class="btn btn-sm btn-danger">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-warning">SI</button>
                                                @endif
                                            </td>

                                            <td align="center" class="button">
                                                @if ($lote->estado_egresos == '0')
                                                    <button type="button" class="btn btn-sm btn-danger">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-warning">SI</button>
                                                @endif
                                            </td>
                                            <td align="center" class="button">
                                                <a href="{{ route('reportes.generar_pdf', $lote->id) }}" target="_blank"
                                                    class="btn btn-lg btn-primary"><i class="far fa-file-pdf"></i></a>
                                            </td>

                                            <td align="center" class="button">
                                                <a href="{{ route('reportes.generar_excel', $lote->id) }}"
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
                        {{ $lotes->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span> --}}
                    </div>
                    <br>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#lote" role="tab"
                                aria-controls="lote" aria-selected="true">
                                <h6>INGRESOS / LOTE # <label id="nombre_lote"></label></h6>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#egresos" role="tab"
                                aria-controls="egresos" aria-selected="false">
                                <h6>EGRESOS # <label id="peso_neto"></label></h6>
                            </a>
                        </li>
                    </ul>                    

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="lote" role="tabpanel" aria-labelledby="lote">
                        <!-- Gavetas con pollos !-->
                        <div class="row">  
                            <div class="col-md-auto">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-secondary">
                                            <tr class="font-weight-bold">
                                                <td align="center">ID</td>
                                                <td align="center" width="20">Cantidad Gavetas</td>
                                                <td align="center" width="5">Peso Bruto</td>
                                                <td align="center" width="5">Tipo Peso</td>
                                                <td align="center">Estado</td>
                                                <td align="center">Observación</td>
                                                <td align="center">Usuario creación</td>
                                                <td align="center">Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <!--tbody!-->
                                        <tbody id="cuerpo_lote">
                                        </tbody>
                                        <tr class="font-weight-bold">
                                            <td align="center" colspan="1"><b>TOTAL</b></td>
                                            <td align="center" id="total_cantidad"><b></b></td>
                                            <td align="center" id="total_bruto"><b></b></td>
                                            <!--td id="total_gavetas"><b></b></td>
                                            <td id="total_final"><b></b></td!-->
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!--div class="col-sm-1"></div!-->
                            <!-- Gavetas vacías !-->
                            <div class="col-md-auto">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-secondary">
                                            <tr class="font-weight-bold">
                                                <td align="center">ID</td>
                                                <td align="center" width="20">Cantidad Gavetas vacías</td>
                                                <td align="center" width="20">Peso gavetas vacías</td>
                                                <!--td>Peso Gavetas</td>
                                                <td>Peso Final</td!-->
                                                <td align="center" width="5">Tipo Peso</td>
                                                <td align="center">Estado</td>
                                                <td align="center">Observación</td>
                                                <td align="center">Usuario creación</td>
                                                <td align="center">Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <!--tbody!-->
                                        <tbody id="cuerpo_gvacia">
                                        </tbody>
                                        <tr class="font-weight-bold">
                                            <td align="center" colspan="1"><b>TOTAL</b></td>
                                            <td align="center" id="total_cantidad_gvacias"><b></b></td>
                                            <td align="center" id="total_peso_gvacias"><b></b></td>
                                            <!--td id="total_gavetas"><b></b></td>
                                            <td id="total_final"><b></b></td!-->
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                        </div>

                      

                        <div class="tab-pane fade" id="egresos" role="tabpanel" aria-labelledby="egresos">
                        <div class="row">  
                            <!-- Tabla gavetas con pollos Egresos !-->
                            <div class="col-md-auto">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class="table-secondary">
                                                <tr class="font-weight-bold">
                                                    <td align="center">ID Lote</td>
                                                    <td align="center" width="20">Cantidad Gavetas</td>
                                                    <td align="center">Peso Bruto</td>
                                                    <td align="center">Cantidad Animales</td>
                                                    <td align="center">Tipo Peso</td>
                                                    <td align="center">Estado</td>
                                                    <td align="center">Observación</td>
                                                    <td align="center">Usuario creación</td>
                                                    <td align="center">Fecha de Registro</td>
                                                </tr>
                                            </thead>
                                            <!--tbody!-->
                                            <tbody id="cuerpo_egresos">
                                            </tbody>
                                            <tr class="font-weight-bold">
                                                <td align="center" colspan="1"><b>TOTAL</b></td>
                                                <td align="center" id="total_cantidade"><b></b></td>
                                                <td align="center" id="total_brutoe"><b></b></td>
                                                <td align="center" id="total_cant_animal_e"><b></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                 </div>

                                <!-- tabla Gavetas vacías Egresos !-->
                                <div class="col-md-auto">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-secondary">
                                            <tr class="font-weight-bold">
                                                <td align="center">ID</td>
                                                <td align="center" width="20">Cantidad Gavetas vacías</td>
                                                <td align="center" width="20">Peso gavetas vacías</td>
                                                <!--td>Peso Gavetas</td>
                                                <td>Peso Final</td!-->
                                                <td align="center" width="5">Tipo Peso</td>
                                                <td align="center">Estado</td>
                                                <td align="center">Observación</td>
                                                <td align="center">Usuario creación</td>
                                                <td align="center">Fecha de Registro</td>
                                            </tr>
                                        </thead>
                                        <!--tbody!-->
                                        <tbody id="cuerpo_gvacia_egreso">
                                        </tbody>
                                        <tr class="font-weight-bold">
                                            <td align="center" colspan="1"><b>TOTAL</b></td>
                                            <td align="center" id="total_cantidad_gvacias_egresos"><b></b></td>
                                            <td align="center" id="total_peso_gvacias_egresos"><b></b></td>
                                            <!--td id="total_gavetas"><b></b></td>
                                            <td id="total_final"><b></b></td!-->
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
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#excel-consolidado').hover(function(){
                $(this).css('cursor','pointer').attr('title','Reporte Consolidado');
            },function(){
                $(this).css('cursor','auto');
            })

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
                var tg = 0;
                var tf = 0;
                var tcv = 0;
                var tbv = 0;
                var tgv = 0;
                var tfv = 0;
                var tce = 0;
                var tbe = 0;
                var tge = 0;
                var tcanimales = 0;
                var tfe = 0;
                var tcgv = 0;
                var tpgv = 0;
                var tcgve = 0;
                var tpgve = 0;
                var id_acum = 0;
                var id_acume = 0;
                var id_acumgv= 0;
                var id_acumgve= 0;


                //console.log(id);

                //document.querySelector('#nombre_lote').innerText = id;
                $('#nombre_lote').text(id);
                $('#peso_neto').text(id);

                $.ajax({
                    data: {
                        id: id
                    },
                    url: '/reportes/detalle_lotes',
                    type: 'post',
                    //dataType:'json',
                    success: function(response) {
                        $("#cuerpo_lote").html("");
                        //var obj = Object.values(response);
                        $.each(response, function(index, value) {
                            var fech = new Date(value.created_at);
                            var fecha = fech.toLocaleString();
                            $("#cuerpo_lote").append(
                                $('<tr>'),
                                $('<td align="center">').text(id_acum=id_acum+1),
                                $('<td align="center">').text(value.cant_gavetas),
                                $('<td align="center">').text(value.peso_bruto),
                                /*$('<td>').text(value.peso_gavetas),
                                $('<td>').text(value.peso_final),*/
                                $('<td align="center">').text(value.tipo_peso),
                                (value.anulado === '1') ? $('<td>').text(
                                    'Anulado') :
                                $('<td align="center">').text(''),
                                $('<td align="center">').text(value.observaciones),
                                $('<td align="center">').text(value.usuario_creacion),
                                $('<td align="center">').text(fecha),
                                $('</tr>'));
                            if (value.anulado === '0') {
                                tc = tc + parseFloat(value.cant_gavetas);
                                tb = tb + parseFloat(value.peso_bruto);
                                tg = tg + parseFloat(value.peso_gavetas);
                                tf = tf + parseFloat(value.peso_final);
                            }
                        })


                        $('#total_cantidad').text(tc);
                        $('#total_bruto').text(tb);
                        $('#total_gavetas').text(tg);
                        $('#total_final').text(tf);


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
                    url: '/reportes/detalle_gvacias',
                    type: 'post',
                    //dataType:'json',
                    success: function(response) {
                        $("#cuerpo_gvacia").html("");
                        //var obj = Object.values(response);
                        $.each(response, function(index, value) {
                            var fech = new Date(value.created_at);
                            var fecha = fech.toLocaleString();
                            $("#cuerpo_gvacia").append(
                                $('<tr>'),
                                $('<td align="center">').text(id_acumgv=id_acumgv+1),
                                $('<td align="center">').text(value.cant_gavetas_vacias),
                                $('<td align="center">').text(value.peso_gavetas_vacias),
                                /*$('<td>').text(value.peso_gavetas),
                                $('<td>').text(value.peso_final),*/
                                $('<td align="center">').text(value.tipo_peso),
                                (value.anulado === '1') ? $('<td>').text(
                                    'Anulado') :
                                $('<td align="center">').text(''),
                                $('<td align="center">').text(value.observaciones),
                                $('<td align="center">').text(value.usuario_creacion),
                                $('<td align="center">').text(fecha),
                                $('</tr>'));
                            if (value.anulado === '0') {
                                tcgv = tcgv + parseFloat(value.cant_gavetas_vacias);
                                tpgv = tpgv + parseFloat(value.peso_gavetas_vacias);
                                //tg = tg + parseFloat(value.peso_gavetas);
                                //tf = tf + parseFloat(value.peso_final);
                            }
                        })

                        $('#total_cantidad_gvacias').text(tcgv);
                        $('#total_peso_gvacias').text(tpgv);


                       // document.querySelector('#total_gavetas').innerText = tg;
                       // document.querySelector('#total_final').innerText = tf;
                        //  console.log(typeof(obj));
                        //  console.log(response);
                        //   alert(response);

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
                    url: '/reportes/detalle_egresos',
                    type: 'post',
                    //dataType:'json',
                    success: function(response) {
                        $("#cuerpo_egresos").html("");
                        //var obj = Object.values(response);
                        $.each(response, function(index, value) {
                            var fech = new Date(value.created_at);
                            var fecha = fech.toLocaleString();
                            $("#cuerpo_egresos").append(
                                $('<tr>'),
                               $('<td align="center">').text(id_acume=id_acume+1),
                                $('<td align="center">').text(value.cant_gavetas),
                                $('<td align="center">').text(value.peso_bruto),
                                $('<td align="center">').text(value.cant_animales),
                                $('<td align="center">').text(value.tipo_peso),
                                (value.anulado === '1') ? $('<td>').text(
                                    'Anulado') :
                                $('<td align="center">').text(''),
                                $('<td align="center">').text(value.observaciones),
                                $('<td align="center">').text(value.usuario_creacion),
                                $('<td align="center">').text(fecha),
                                $('</tr>'));
                            if (value.anulado === '0') {
                                tce = tce + parseFloat(value.cant_gavetas);
                                tbe = tbe + parseFloat(value.peso_bruto);
                                tcanimales = tcanimales + parseFloat(value.cant_animales);
                                tge = tge + parseFloat(value.peso_gavetas);
                                tfe = tfe + parseFloat(value.peso_final);

                            }
                        })

                        $('#total_cantidade').text(tce);
                        $('#total_brutoe').text(tbe);
                        $('#total_cant_animal_e').text(tcanimales);
                        $('#total_gavetase').text(tge);
                        $('#total_finale').text(tfe);

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
                    url: '/reportes/detalle_gvacias_egresos',
                    type: 'post',
                    //dataType:'json',
                    success: function(response) {
                        $("#cuerpo_gvacia_egreso").html("");
                        //var obj = Object.values(response);
                        $.each(response, function(index, value) {
                            var fech = new Date(value.created_at);
                            var fecha = fech.toLocaleString();
                            $("#cuerpo_gvacia_egreso").append(
                                $('<tr>'),
                                $('<td align="center">').text(id_acumgve=id_acumgve+1),
                                $('<td align="center">').text(value.cant_gavetas_vacias),
                                $('<td align="center">').text(value.peso_gavetas_vacias),
                                /*$('<td>').text(value.peso_gavetas),
                                $('<td>').text(value.peso_final),*/
                                $('<td align="center">').text(value.tipo_peso),
                                (value.anulado === '1') ? $('<td>').text(
                                    'Anulado') :
                                $('<td align="center">').text(''),
                                $('<td align="center">').text(value.observaciones),
                                $('<td align="center">').text(value.usuario_creacion),
                                $('<td align="center">').text(fecha),
                                $('</tr>'));
                            if (value.anulado === '0') {
                                tcgve = tcgve + parseFloat(value.cant_gavetas_vacias);
                                tpgve = tpgve + parseFloat(value.peso_gavetas_vacias);
                                //tg = tg + parseFloat(value.peso_gavetas);
                                //tf = tf + parseFloat(value.peso_final);
                            }
                        })

                        $('#total_cantidad_gvacias_egresos').text(tcgve);
                        $('#total_peso_gvacias_egresos').text(tpgve);


                       // document.querySelector('#total_gavetas').innerText = tg;
                       // document.querySelector('#total_final').innerText = tf;
                        //  console.log(typeof(obj));
                        //  console.log(response);
                        //   alert(response);

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
