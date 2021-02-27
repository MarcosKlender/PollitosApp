@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Reportes PESO EN BRUTO</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        

                        <div class="mb-3">
                            <form method="get" action="{{ route('reportes.show', 'search') }}">
                               
                               
                                <div class="input-group">

                                     <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_tipo" name="criterio_tipo" class="form-control"  placeholder="Buscar tipo"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                        <input type="search" id="criterio_proveedor" name="criterio_proveedor" class="form-control"  placeholder="Buscar proveedor"  >
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_procedencia" name="criterio_procedencia" class="form-control"  placeholder="Buscar procedencia">
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_placa" name="criterio_placa" class="form-control"  placeholder="Buscar placa">
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_conductor" name="criterio_conductor" class="form-control"  placeholder="Buscar conductor">
                                    </div>

                                    <div class="col-auto input-group-append">
                                         <input type="search" id="criterio_usuario" name="criterio_usuario" class="form-control"  placeholder="Buscar usuario">
                                    </div>


                                        <label for="fecha_ini"> Desde:</label>
                                        <div class=" col-md-2 mt-lg-0 mt-md-0 mt-2">
                                             <input type="date" class="form-control ml-2" name="criterio_fecha_ini">
                                        </div>

                                        <label for="fecha_fin"> Hasta:</label>
                                        <div class="input-group col-md-2 mt-lg-0 mt-md-0 mt-2">
                                            <input type="date" class="form-control ml-2" name="criterio_fecha_fin">
                                        </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="criterio_anulado" value="1" name="criterio_anulado">
                                        <label class="form-check-label" for="inlineCheckbox1"> Anulado </label>
                                    </div>

                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="criterio_liquidado" value="1" name="criterio_liquidado">
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
                        <div class="alert alert-danger">No se han encontrado lotes.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="reportes_peso" >
                                <thead>
                                    <tr>
                                        <td>N° Lote</td>
                                        <td>Tipo</td>
                                        <td>Proveedor</td>
                                        <td>Procedencia</td>                                       
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                        <td>Tot. Cant. Gavetas</td>
                                        <td>Tot. Peso Bruto</td>
                                        <td>Tot. Peso Gavetas</td>
                                        <td>Tot. Peso Final</td>
                                        <td>Usuario</td>
                                        <td>Fecha de Registro</td>
                                        <td>Anulado</td>
                                        <td>Liquidado</td>
                                        <td>Acciones</td>
                                        <td>Reporte pdf</td>
                                        <td>Reporte excel</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote)
                                        <tr>
                                            <td id="{{ $lote->id}}" >{{ $lote->id }}</td>
                                            <td id="detalle">{{ $lote->tipo }}</td>
                                            <td id="detalle">{{ $lote->proveedor }}</td>
                                            <td>{{ $lote->procedencia }}</td>                                           
                                            <td>{{ $lote->placa }}</td>
                                            <td>{{ $lote->conductor }}</td>
                                            <td>{{ $lote->total_cant_gavetas }}</td>
                                            <td>{{ $lote->total_peso_bruto }}</td>
                                            <td>{{ $lote->total_peso_gavetas }}</td>
                                            <td>{{ $lote->total_peso_final }}</td>
                                            <td>{{ $lote->usuario }}</td>
                                            <td>{{ $lote->created_at }}</td>
                                            <td class="button">
                                            @if ($lote->anulado == '0')
                                                 <button id="btn_prueba" class="btn btn-sm btn-primary" type="submit">NO</button>
                                                 @else
                                                  <button class="btn btn-sm btn-danger" type="submit">SI</button>
                                            @endif
                                             </td>

                                            <td class="button">
                                                @if ($lote->liquidado == '0')
                                                    <button type="button" class="btn btn-sm btn-info">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-warning">SI</button>
                                                @endif
                                            </td>
                                            <td class="button">
                                                @if ($lote->liquidado == '0')
                                                    <a href="#"
                                                        class="btn btn-sm btn-primary">Registrar Pesos</a>
                                                @else
                                                    <a href="{{ route('pesobruto.show', $lote->id) }}"
                                                        class="btn btn-sm btn-primary">Ver Pesos</a>
                                                @endif
                                            </td>
                                            <td class="button">
                                                     <a href="{{ route('reportes.generar_pdf',$lote->id) }}" target="_blank"
                                                        class="btn btn-sm btn-primary"><i class="far fa-file-pdf"></i></a>
                                            </td>
                                             <td class="button">
                                                     <a href="{{ route('reportes.generar_excel',$lote->id) }}" target="_blank"
                                                        class="btn btn-sm btn-primary" ><i class="far fa-file-pdf"></i></a>
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
                            <b>{{ $count }}</b></span>--}}
                    </div>
                    <br>
                       <h4><strong>DETALLE DEL LOTE # </strong><label id="nombre_lote"></label></h4>
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Cantidad de Gavetas</td>
                                        <td>Peso Bruto</td>
                                        <td>Peso Gavetas</td>
                                        <td>Peso Final</td>
                                        <td>Usuario</td>
                                        <td>Fecha de Registro</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody id="cuerpo">
                                </tbody>
                                 <tr>
                                        <td colspan="1"><b>TOTAL</b></td>
                                        <td id="total_cantidad"><b></b></td>
                                        <td id="total_bruto"><b></b></td>
                                        <td id="total_gavetas"><b></b></td>
                                        <td id="total_final"><b></b></td>
                                    </tr>
                              </table>

                </div>
            </div>
        </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script type="text/javascript">

            $("#reportes_peso").on('click', 'tr', function (e){
           // $("#reportes_peso tbody tr").click(function(e){


                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
  
                    var id=$(this).find("td:first-child ").html(); 

                     var tc=0;
                     var tb=0;
                     var tg=0;
                     var tf=0;

                     console.log(id);
                    
                    document.querySelector('#nombre_lote').innerText = id;
 
                    $.ajax({                       
                        data:{id:id},
                        url:'/reportes/detalle_lotes',
                        type:'post',
                        //dataType:'json',
                        success: function(response){
                            $("#cuerpo").html("");
                            //var obj = Object.values(response);
                             $.each(response, function(index, value) {
                         $("#cuerpo").append(
                        $('<tr>'),
                        $('<td>').text(value.id),
                        $('<td>').text(value.cant_gavetas),
                        $('<td>').text(value.peso_bruto  ),
                        $('<td>').text(value.peso_gavetas),
                        $('<td>').text(value.peso_final  ),
                        $('<td>').text(value.usuario     ),
                        $('<td>').text(value.updated_at),
                        $('</tr>'));
                         tc = tc+ parseFloat(value.cant_gavetas);
                         tb = tb+ parseFloat(value.peso_bruto);
                         tg = tg+ parseFloat(value.peso_gavetas);
                         tf = tf+ parseFloat(value.peso_final);
                         })
                        document.querySelector('#total_cantidad').innerText = tc;
                        document.querySelector('#total_bruto').innerText = tb ;
                        document.querySelector('#total_gavetas').innerText = tg ;
                        document.querySelector('#total_final').innerText = tf ;
                        //  console.log(typeof(obj));
                         //  console.log(response);
                        //   alert(response);
                           
                        },
                        statusCode:{
                            404: function(){
                                alert('web no encontrada');
                            }
                        },
                        error:function(response){
                            alert(response);
                        }


                     }); 

                        
                 


               });

        });
          
     </script>
   

@endsection
