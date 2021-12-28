<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte</title>
    <link rel="stylesheet" href="css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="/var/www/html/PollitosApp/public/img/pollovencedor.png" width="70" height="70"><!-- AQUI VA EL LOGO DE LA EMPRESA -->
      </div>
        <div>Santo Domingo de los Colorados, La Concordia</div>
        <div>Dirección: Mercado Central</div>
        <div>Celular: 099 358 2202</div>
      </div>
      <h3></h3>
      <div id="company" class="clearfix">
    </header>
    <main>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                
                <div class="card-body">
       
                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($count == 0)
                        <div class="alert alert-danger">No se han encontrado lotes.</div>
                    @else
                     @foreach ($lotes as $lote) 
                     @if($lote->id==$id_lote) 
                        <div class="card-header mt-2">
                                <div class="text-center">
                              <!--h4>CABECERA DEL LOTE N° {{ $lote->id }} </h4!-->
                           </div>
                        </div> 
                        
                        <div style="clear:both; position:relative;">
                            <div>   <strong>N° Lote: </strong>           <label>{{ $lote->id }}                </label></div>
                        <div style="position:absolute; left:0pt; width:192pt;">   
                         <div>   <strong>Tipo: </strong>            <label>{{ $lote->tipo }}                    </label></div>
                         <div>   <strong>Cantidad: </strong>            <label>{{ $lote->cantidad }}            </label></div>
                         <div>   <strong>Proveedor:</strong>         <label>{{ $lote->proveedor }}              </label></div>
                         <div>   <strong>RUC / C.I:</strong>         <label>{{ $lote->ruc_ci }}                 </label></div>   
                         <div>   <strong>Procedencia: </strong>       <label>{{ $lote->procedencia }}           </label></div>                       
                        </div>
                        <div style="margin-left:200pt;">
                         <div>   <strong>Placa:     </strong>         <label>{{ $lote->placa }}                  </label></div>
                         <div>   <strong>Conductor:  </strong>        <label>{{ $lote->conductor }}              </label></div>
                         <div>   <strong>Usuario:       </strong>     <label>{{ $lote->usuario }}                </label></div>
                         <div>   <strong>Fecha Creacion:</strong>  <label>{{ $lote->created_at }}                </label></div>
                         <div>   <strong>Estado:</strong>  <label>{{ $liquidado}}                                </label></div>
                        </div>
                        </div>
                       <div>
                        <br/>
                        <br/>
                        <?php $sumv_pb=0; $sumv_pg=0; $sumv_pf=0; $sume_cg=0; $sume_pb=0; $sume_pg=0; $sume_pf=0 ; ?>
                         <div class="card-header mt-2">
                                <div class="text-center">
                              <h4>INGRESOS LOTE N° {{ $lote->id }} </h4>
                           </div>
                        </div> 

                        <!-- Peso bruto !-->
                           <div class="card-header mt-2">
                                <div class="text-center">
                                    <h4>Peso Bruto </h4>
                                 </div>
                            </div> 

                       <div class="table-responsive mt-3">
                            <table border="1">
                                <thead>
                                    <tr>
                                        <td>ID Lote</td>
                                        <td>Cantidad de Gavetas</td>
                                        <td>Peso Bruto</td>
                                        <!--td>Peso Gavetas</td!-->
                                        <!--td>Peso Final</td!-->
                                        <td>Usuario</td>
                                        <td>Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $reg)
                                    @if($lote->id==$reg->lotes_id)
                                        <tr>
                                            
                                            <td>{{ $reg->lotes_id }}</td>
                                            <td>{{ $reg->cant_gavetas }}</td>
                                            <td>{{ $reg->peso_bruto }}</td>
                                            <!--td>{{ $reg->peso_gavetas }}</td!-->
                                            <!--td>{{ $reg->peso_final }}</td!-->
                                            <td>{{ $reg->usuario }}</td>
                                            <td>{{ $reg->updated_at }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="1"><b>TOTAL</b></td>
                                        <td><b>{{ $lote->total_cant_gavetas }}</b></td>
                                        <td><b>{{ $lote->total_peso_bruto }}  </b></td>
                                        <!--td><b>{{ $lote->total_peso_gavetas }}</b></td!-->
                                        <!--td><b>{{ $lote->total_peso_final }}  </b></td!-->
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Peso gavetas !-->
                        <div class="card-header mt-2">
                                <div class="text-center">
                                    <h4>Peso Gavetas Vacías </h4>
                                 </div>
                        </div> 

                        <div class="table-responsive mt-3">
                            <table border="1">
                                <thead>
                                    <tr>
                                        <td>ID Lote</td>
                                        <td>Cantidad de Gavetas</td>
                                        <td>Peso Gavetas</td>
                                        <!--td>Peso Final</td!-->
                                        <td>Usuario</td>
                                        <td>Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gavetas_vacias as $gav_vacias)
                                    @if($lote->id==$gav_vacias->lotes_id)
                                        <tr>
                                            <td>{{ $gav_vacias->lotes_id }}</td>
                                            <td>{{ $gav_vacias->cant_gavetas_vacias }}</td>
                                            <td>{{ $gav_vacias->peso_gavetas_vacias }}</td>
                                            <!--td>{{ $gav_vacias->peso_final }}</td!-->
                                            <td>{{ $gav_vacias->usuario }}</td>
                                            <td>{{ $gav_vacias->updated_at }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="1"><b>TOTAL</b></td>
                                        @foreach($lotes_gavetas as $lote_gvacia)                                 
                                        @if($lote->id == $lote_gvacia->id)
                                            <td><b>{{ $lote_gvacia->total_cant_gavetas_vacias }}</b></td>
                                            <td><b>{{ $lote_gvacia->total_peso_gavetas_vacias }}  </b></td>
                                            <!--td><b>{{ $lote_gvacia->total_peso_gavetas }}</b></td!-->
                                            <!--td><b>{{ $lote_gvacia->total_peso_final }}  </b></td!-->
                                        @endif
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                         <!-- Peso gavetas !-->
                        <div class="card-header mt-2">
                                <div class="text-center">
                                    <h4>Cantidad Ahogados </h4>
                                 </div>
                        </div> 

                        <div class="table-responsive mt-3">
                            <table border="1">
                                <thead>
                                    <tr>
                                        <td>ID Lote</td>
                                        <td>Cantidad de ahogados</td>
                                        <td>Peso ahogados</td>
                                        <!--td>Peso Final</td!-->
                                        <td>Usuario</td>
                                        <td>Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote_ahogados)
                                   

                                    @if($lote->id==$lote_ahogados->id)
                                        <tr>
                                            <td>{{ $lote_ahogados->id }}</td>
                                            <td>{{ $lote_ahogados->cant_ahogados }}</td>
                                            <td>{{ $lote_ahogados->peso_ahogados }}</td>
                                            <!--td>{{ $gav_vacias->peso_final }}</td!-->
                                            <td>{{ $lote_ahogados->usuario }}</td>
                                            <td>{{ $lote_ahogados->updated_at }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <!--tr>
                                        <td colspan="1"><b>TOTAL</b></td>
                                        @foreach($lotes_gavetas as $lote_gvacia)                                 
                                        @if($lote->id == $lote_gvacia->id)
                                            <td><b>{{ $lote_gvacia->total_cant_gavetas_vacias }}</b></td>
                                            <td><b>{{ $lote_gvacia->total_peso_gavetas_vacias }}  </b></td>
                                            <!--td><b>{{ $lote_gvacia->total_peso_gavetas }}</b></td!-->
                                            <!--td><b>{{ $lote_gvacia->total_peso_final }}  </b></td>
                                        @endif
                                        @endforeach
                                    </tr!-->
                                </tbody>
                            </table>
                        </div>
                      

                        <!--div class="card-header mt-2">
                                <div class="text-center">
                              <h4>DETALLE VISCERAS LOTE N° {{ $lote->id }} </h4>
                           </div>
                        </div!--> 

                        <!--div class="table-responsive mt-3">
                            <table  border="1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>ID Lote</td>
                                        <td>Tipo</td>
                                        <td>Peso Bruto</td>
                                        <td>Peso Gavetas</td>
                                        <td>Peso Final</td>
                                        <td>Usuario</td>
                                        <td>Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visceras as $viscera)
                                        <tr>
                                            <td>{{ $viscera->id }}</td>
                                            <td>{{ $viscera->lotes_id }}</td>
                                            <td>{{ $viscera->tipo }}</td>
                                            <td>{{ $viscera->peso_bruto }}</td>
                                            <td>{{ $viscera->peso_gavetas }}</td>
                                            <td>{{ $viscera->peso_final }}</td>
                                            <td>{{ $viscera->usuario }}</td>
                                            <td>{{ $viscera->updated_at }}</td>
                                        </tr>
                                           {{$sumv_pb=$sumv_pb+$viscera->peso_bruto}}
                                           {{$sumv_pg=$sumv_pg+$viscera->peso_gavetas}}
                                           {{$sumv_pf=$sumv_pf+$viscera->peso_final}}
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><b>TOTAL</b></td>
                                        <td><b>{{ $sumv_pb }}</b></td>
                                        <td><b>{{ $sumv_pg }}</b></td>
                                        <td><b>{{ $sumv_pf }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div!-->




                         <div class="card-header mt-2">
                                <div class="text-center">
                              <h4>EGRESOS LOTE N° {{ $lote->id }} </h4>
                           </div>
                        </div> 


                        <div class="table-responsive mt-3">
                            <table  border="1" class="table table-striped table-bordered">
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
                                    @foreach ($egresos as $egreso)
                                        <tr>
                                            <td>{{ $egreso->id }}</td>
                                            <td>{{ $egreso->lotes_id }}</td>
                                            <td>{{ $egreso->cant_gavetas }}</td>
                                            <td>{{ $egreso->peso_bruto }}</td>
                                            <td>{{ $egreso->peso_gavetas }}</td>
                                            <td>{{ $egreso->peso_final }}</td>
                                            <td>{{ $egreso->usuario }}</td>
                                            <td>{{ $egreso->updated_at }}</td>
                                        </tr>
                                        {{$sume_cg=$sume_cg+$egreso->cant_gavetas}}
                                        {{$sume_pb=$sume_pb+$egreso->peso_bruto}}
                                        {{$sume_pg=$sume_pg+$egreso->peso_gavetas}}
                                        {{$sume_pf=$sume_pf+$egreso->peso_final}}
                                    @endforeach
                                    <tr>
                                        <td colspan="2"><b>TOTAL</b></td>
                                        <td><b>{{ $sume_cg }}</b></td>
                                        <td><b>{{ $sume_pb }}</b></td>
                                        <td><b>{{ $sume_pg }}</b></td>
                                        <td><b>{{ $sume_pf }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        </div>
                        <hr>
                        @endif
                        @endforeach
                      </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $lotes->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span>--}}
                    </div>

 

                </div>
            </div>
        </div>
    </div>


