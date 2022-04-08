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
                        <div class="alert alert-danger">No se han encontrado entregas.</div>
                    @else
                     @foreach ($entregas as $entrega) 
                     @if($entrega->id==$id_entrega) 
                        <div class="card-header mt-2">
                                <div class="text-center">
                           </div>
                        </div> 
                        
                        <div style="clear:both; position:relative;">
                            <div>   <strong>N°: </strong>           <label>{{ $entrega->id }}                </label></div>
                        <div style="position:absolute; left:0pt; width:192pt;">   
                         <div>   <strong>Tipo: </strong>            <label>{{ $entrega->tipo }}                    </label></div>
                         <div>   <strong>Cantidad Animales: </strong>            <label>{{ $entrega->cant_animales }}            </label></div>
                         <div>   <strong>Cliente:</strong>         <label>{{ $entrega->cliente }}              </label></div>
                         <div>   <strong>RUC / C.I:</strong>         <label>{{ $entrega->ruc_ci }}                 </label></div>   
                         <div>   <strong>Destino: </strong>       <label>{{ $entrega->destino }}           </label></div>

                        </div>
                        <div style="margin-left:200pt;">
                         <div>   <strong>Placa:     </strong>         <label>{{ $entrega->placa }}                  </label></div>
                         <div>   <strong>Conductor:  </strong>        <label>{{ $entrega->conductor }}              </label></div>
                         <div>   <strong>Usuario creación:       </strong>     <label>{{ $entrega->usuario_creacion }}                </label></div>
                         <div>   <strong>Fecha Creacion:</strong>  <label>{{ $entrega->created_at }}                </label></div>
                         <div>   <strong>Estado:</strong>  <label>{{ $liquidado}}                                </label></div>
                          <div>   <strong>Para local:</strong>  <label>@if( $entrega->tipo_entrega == 1 ) Si @else No  @endif                               </label></div>
                        </div>
                        </div>
                       <div>
                        <br/>
                        <br/>
                        <?php $sumv_pb=0; $sumv_pg=0; $sumv_pf=0; $sume_cg=0; $sume_pb=0; $sume_pg=0; $sume_pf=0 ; ?>
                         
                         <div class="card-header mt-2">
                                <div class="text-center">
                              <h4>ENTREGAS N° {{ $entrega->id }} </h4>
                           </div>
                        </div> 

                        <!-- Peso Neto registros !-->
                           <div class="card-header mt-2">
                                <div class="text-center">
                                    <h4>Registro Pesos </h4>
                                 </div>
                            </div> 

                       <div class="table-responsive mt-3">
                            <table border="1">
                                <thead>
                                    <tr>
                                        <td align="center">N°</td>
                                        <td align="center">Cantidad de Gavetas</td>
                                        <td align="center">Peso Bruto</td>
                                        <td align="center">Categoria animal</td>
                                        <td align="center">Usuario creación</td>
                                        <td align="center">Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros_entregas as $registros)
                                        <tr>
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td align="center">{{ $registros->cant_gavetas }}</td>
                                            <td align="center">{{ $registros->peso_bruto }}</td>
                                            <td align="center">{{ $registros->categoria_animales }}</td>
                                            <td align="center">{{ $registros->usuario_creacion }}</td>
                                            <td align="center">{{ $registros->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="1"><b>TOTAL</b></td>
                                        <td align="center"><b>{{ $entrega->total_cant_gavetas }}</b></td>
                                        <td align="center"><b>{{ $entrega->total_peso_bruto }}  </b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Peso gavetas vacias !-->
                        <div class="card-header mt-2">
                                <div class="text-center">
                                    <h4>Peso Presas </h4>
                                 </div>
                        </div> 

                        <div class="table-responsive mt-3">
                            <table border="1">
                                <thead>
                                    <tr>
                                        <td align="center">N°</td>
                                        <td align="center"> Tipo presas</td>
                                        <td align="center">Cantidad de Gavetas</td>
                                        <td align="center">Peso Gavetas</td>
                                        <td align="center">Usuario creación</td>
                                        <td align="center">Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presas_entregas as $presas)
                                        <tr>
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td align="center">{{ $presas->tipo_entrega }}</td>
                                            <td align="center">{{ $presas->cant_gavetas }}</td>
                                            <td align="center">{{ $presas->peso_bruto }}</td>
                                            <td align="center">{{ $presas->usuario_creacion }}</td>
                                            <td align="center">{{ $presas->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" align="center"><b>TOTAL</b></td>
                                        @foreach($entregas_presas as $epresas)                                 
                                        @if($entrega->id == $epresas->id) 
                                            <td align="center"><b>{{ $epresas->total_cant_gavetas }}</b></td>
                                            <td align="center"><b>{{ $epresas->total_peso_gavetas }}  </b></td>
                                        @endif
                                        @endforeach 
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
                        {{ $entregas->links() }}
                        {{-- <span>Total de Lotes:
                            <b>{{ $count }}</b></span>--}}
                    </div>

 

                </div>
            </div>
        </div>
    </div>


