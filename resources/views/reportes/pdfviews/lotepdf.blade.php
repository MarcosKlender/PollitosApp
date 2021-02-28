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
        <img src="img/logo.png"><!-- AQUI VA EL LOGO DE LA EMPRESA -->
      </div>
        <div>Santo Domingo de los Colorados</div>
        <div>------------------------------</div>
        <div>-------------------</div>
      </div>
      <h1>REPORTES</h1>
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
                              <h4>CABECERA DEL LOTE N° {{ $lote->id }} </h4>
                           </div>
                        </div> 
                        
                        <div style="clear:both; position:relative;">
                        <div style="position:absolute; left:0pt; width:192pt;">
                         <div>   <strong>N° Lote: </strong>           <label>{{ $lote->id }}                     </label></div>  
                         <div>   <strong>Tipo: </strong>            <label>{{ $lote->tipo }}                   </label></div>
                         <div>   <strong>Proveedor:</strong>         <label>{{ $lote->proveedor }}              </label></div>
                         <div>   <strong>Procedencia: </strong>       <label>{{ $lote->procedencia }}            </label></div> 
                        </div>
                        <div style="margin-left:200pt;">
                         <div>   <strong>Placa:     </strong>         <label>{{ $lote->placa }}                  </label></div>
                         <div>   <strong>Conductor:  </strong>        <label>{{ $lote->conductor }}              </label></div>
                         <div>   <strong>Usuario:       </strong>     <label>{{ $lote->usuario }}           </label></div>
                         <div>   <strong>Fecha de Registro:</strong>  <label>{{ $lote->created_at }}             </label></div>
                        </div>
                        </div>
                       <div>
                         <div class="card-header mt-2">
                                <div class="text-center">
                              <h4>DETALLE LOTE N° {{ $lote->id }} </h4>
                           </div>
                        </div> 
                       <div class="table-responsive mt-3">
                            <table border="1">
                                <thead>
                                    <tr>
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
                                    @foreach ($registros as $reg)
                                    @if($lote->id==$reg->lotes_id)
                                        <tr>
                                            
                                            <td>{{ $reg->lotes_id }}</td>
                                            <td>{{ $reg->cant_gavetas }}</td>
                                            <td>{{ $reg->peso_bruto }}</td>
                                            <td>{{ $reg->peso_gavetas }}</td>
                                            <td>{{ $reg->peso_final }}</td>
                                            <td>{{ $reg->usuario }}</td>
                                            <td>{{ $reg->updated_at }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="1"><b>TOTAL</b></td>
                                        <td><b>{{ $lote->total_cant_gavetas }}</b></td>
                                        <td><b>{{ $lote->total_peso_bruto }}  </b></td>
                                        <td><b>{{ $lote->total_peso_gavetas }}</b></td>
                                        <td><b>{{ $lote->total_peso_final }}  </b></td>
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


