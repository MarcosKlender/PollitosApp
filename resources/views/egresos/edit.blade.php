@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4><b>EGRESOS</b> | LOTE {{ $lote->id }} | {{ $lote->tipo }} | {{ $lote->proveedor}}</h4>
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
                                    <div class="form-group col-lg-4">
                                        <label for="cant_gavetas">Cantidad de Gavetas llenas</label>
                                        @if( $valor_cant_gaveta_llenas > "0" and $automatico_valor_cgavetas_llenas == '1')
                                            <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                                value="{{ $valor_cant_gaveta_llenas }}" required readonly />
                                        @elseif(  $automatico_valor_cgavetas_llenas == "0" )
                                        <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                            value="{{ old('cant_gavetas') }}" required autofocus />
                                         @endif   
                                    </div>

                                    <!-- Valor cantidad animales egresos !-->
                                    <div class="form-group col-lg-2">
                                        <label for="cant_animales_pesos">Cantidad animales</label>
                                        @if( $valor_cant_animales > '0' and  $automatico_valor_cantidad_animales == '1')
                                            <input type="number" class="bg-warning form-control" id="cant_animales_pesos" name="cant_animales_pesos"
                                                value="{{ $valor_cant_animales }}" required readonly />
                                        @elseif( $automatico_valor_cantidad_animales == '0' )
                                            <input type="number" class="bg-warning p-2 text-dark bg-opacity-10 form-control" id="cant_animales_pesos" name="cant_animales_pesos"
                                                value="{{ old('cant_animales') }}" required autofocus />
                                        @endif

                                          <!-- input hidden para calculo -->  
                                        <input type="hidden" class="form-control" id="total_cant_animales" name="cant_animales"
                                            value="{{ old('cant_animales') }}" />
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="peso_bruto">Peso Bruto</label>
                                        @if ($e_automatico == '1' and $menu == 'EGRESOS')
                                            <div id="recargar" name="recargar"></div>
                                            <span  class="help-inline text-success">Báscula peso automático</span>
                                        @elseif($e_automatico == '0' and $menu == 'EGRESOS')
                                            <input type="number" class="form-control" id="peso_bruto" name="peso_bruto"
                                                value="{{ old('peso_bruto') }}" step=".01" required autofocus/>
                                            <span  class="help-inline text-success">Registro de peso manual</span>
                                        @elseif($e_automatico == null)
                                            <input type="number" class="form-control" id="peso_bruto" name="peso_bruto"
                                                  step=".01" required readonly />
                                            <span  class="help-inline btn-danger">Báscula no asignada</span>
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
                                <input type="hidden" id="peso_gavetas_cero" name="peso_gavetas" value="0" />
                                <input type="hidden" id="peso_final_cero" name="peso_final" value="0" />
                                <input type="hidden" id="lotes_id" name="lotes_id" value="{{ $lote->id }}" required />
                                <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}"
                                    required />
                                <input type="hidden" id="liquidado" name="liquidado" value="0" required />
                                <input type="hidden" id="anulado" name="anulado" value="0" required />
                                
                                <div class="row justify-content-around mt-2">
                                    <a href="{{ route('egresos.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
                                    <button type="submit" class="btn btn-success" id="registrar_peso">Registrar Peso</button>
                                    
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop3" id="modal-desechos" name="modal-desechos"><i class="fa fa-plus"></i></button>
                                </div>
                            </form>

                            @if (count($egresos) != 0)
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped table-bordered" id="tabla_egresos">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>N°</td>
                                                {{-- <td>ID Lote</td> --}}
                                                <td>Cantidad Gavetas</td>
                                                <td>Cantidad Animales</td>
                                                <td>Peso Bruto</td>
                                                <td>Tipo Peso</td>
                                                @if (Auth::user()->rol->key == 'admin')
                                                    <td>Usuario creación</td>
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
                                                    <td>{{ $egreso->cant_animales }}</td>
                                                    <td>{{ $egreso->peso_bruto }}</td>
                                                    <td>{{ $egreso->tipo_peso }}</td>
                                                    @if (Auth::user()->rol->key == 'admin')
                                                        <td>{{ $egreso->usuario_creacion }}</td>
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
                                                            data-id="{{ $egreso->id }}"><i class="far fa-trash-alt fa-lg"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <td><b>{{ $cant_gav }}</b></td>
                                                <td><b>{{ $cant_animales }}</b></td>
                                            </tr>
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
                            @elseif( session()->get('error') )
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

                            <form method="post" action="{{ route('gavetas_vacias_egresos.update', $lote->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="cant_gavetas_vacias">Cantidad de Gavetas Vacías</label>
                                        @if( $valor_cant_gaveta_vacias > "0" and $automatico_valor_gavetas_vacias == "1")
                                        
                                            <input type="number" class="form-control" id="cant_gavetas_vacias"
                                            name="cant_gavetas_vacias" value="{{ $valor_cant_gaveta_vacias }}"
                                            required readonly />
                                            
                                        @elseif(  $automatico_valor_gavetas_vacias == "0" )

                                             <input type="number" class="form-control" id="cant_gavetas_vacias"
                                            name="cant_gavetas_vacias" value="{{ old('cant_gavetas_vacias') }}"
                                            required autofocus />

                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="peso_gavetas_vacias">Peso de Gavetas Vacías</label>
                                        @if ($e_automatico == '1' and $menu == 'EGRESOS')
                                            <div id="recargargve" name="recargargve"></div>
                                            <span  class="help-inline text-success">Báscula peso automático</span>
                                        @elseif($e_automatico == '0' and $menu == 'EGRESOS')
                                            <input type="number" class="form-control" id="peso_gavetas_vacias"
                                                name="peso_gavetas_vacias" value="{{ old('peso_gavetas_vacias') }}"
                                                step=".01" required />
                                            <span  class="help-inline text-success">Registro de peso manual</span>
                                        @elseif($e_automatico == null)
                                            <input type="number" class="form-control" id="peso_gavetas_vacias" name="peso_gavetas_vacias"
                                                  step=".01" required readonly />
                                             <span  class="help-inline btn-danger">Báscula no asignada</span> 
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
                                <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}"
                                    required />
                                <input type="hidden" id="anulado" name="anulado" value="0" required />

                                <div class="row justify-content-around mt-2">
                                    <a href="{{ route('egresos.index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Regresar</i></a>
                                    <button type="submit" class="btn btn-success">Registrar Peso</button>
                                </div>
                            </form>

                            @if (count($gavetas) != 0)
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped table-bordered" id="tabla_egresos_gavetas">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>N°</td>
                                                <td>Cantidad Gavetas Vacías</td>
                                                <td>Peso Gavetas Vacías</td>
                                                <td>Tipo Peso</td>
                                                @if (Auth::user()->rol->key == 'admin')
                                                    <td>Usuario creación</td>
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
                                                        <td>{{ $gaveta->usuario_creacion }}</td>
                                                    @endif
                                                    <td class="text-center"><button type="button"
                                                            class="btn btn-sm btn-danger modal_anular_gavetas"
                                                            data-toggle="modal" data-target="#staticBackdrop4"
                                                            data-id="{{ $gaveta->id }}"><i class="far fa-trash-alt fa-lg"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                              <tr>
                                                <th>Total</th>
                                                <td>{{ $cant_gav_vac }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-danger modal_liquidar" data-toggle="modal" data-target="#staticBackdrop5"
                            id="modal_liquidar" name="modal_liquidar">Liquidar Lote</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

     <!-- Modal para LIQUIDAR -->
    <div class="modal fade" id="staticBackdrop5" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel5" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel5">¿Está seguro de liquidar el lote de egreso?</h5>
                </div>
                <form action="{{ route('egresos.liquidar_lote_egresos') }}" method="post">
                    <div class="modal-body">

                        @if ($cant_gav < $cant_gav_vac)
                            <div class="alert alert-danger" role="alert">
                                La cantidad de gavetas vacías ({{ $cant_gav_vac }}) es mayor a la cantidad de gavetas
                                registradas ({{ $cant_gav }}), corrija esto antes de liquidar este lote de egreso.
                            </div>
                        @elseif($cant_gav > $cant_gav_vac)
                            <div class="alert alert-danger" role="alert">
                                La cantidad de gavetas vacías ({{ $cant_gav }}) es mayor a la cantidad de gavetas
                                registradas ({{ $cant_gav_vac }}), corrija esto antes de liquidar este lote de egreso.
                            </div>
                        @elseif( $lote_total_pbruto <= $egreso_total_pbruto)
                            <div class="alert alert-danger" role="alert">
                                El peso neto ({{ $egreso_total_pbruto }}) del Lote de EGRESO no puede ser superior y tampoco igual al peso bruto ({{ $lote_total_pbruto }}) del Lote de INGRESO, revise y corrija.
                            </div>
                        @elseif( empty($lote->cant_animales_egresos) )
                             <div class="alert alert-danger" role="alert">
                                Cantidad total de {{ $lote->tipo }} faenados no puede ser nulo o cero
                             </div>
                        @elseif( $peso_mollejas_egresos <= 0 || $peso_gvacia_mollejas_egresos <= 0)
                            
                            <div class="alert alert-danger" role="alert">
                                Revisar que esten registrados peso y cantidad de gavetas vacias de MOLLEJAS
                             </div>
                        
                        @elseif( $cant_gav = $cant_gav_vac)
                        
                            @if($estado_liquidado == 1) 
                                <div class="alert alert-warning" role="alert">
                                    Una vez liquidado el EGRESO no podrá registrar más pesos.
                                </div> 
                            @else
                                <div class="alert alert-danger" role="alert">
                                    Revisar que lote N° {{ $lote->id }} de INGRESOS este liquidado!
                                </div>
                            @endif                       
                       @endif
                    </div>
                    <div class="modal-footer">
                        @csrf
                        @if($cant_gav == $cant_gav_vac && $estado_liquidado == 1 && $egreso_total_pbruto < $lote_total_pbruto && !empty($lote->cant_animales_egresos) && $peso_mollejas_egresos > 0 && $peso_gvacia_mollejas_egresos > 0 )
                            
                            <input type="hidden" id="lotes_id" name="lotes_id" value="{{ $lote->id }}">
                            <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}"
                                    required />
                            <input type="hidden" id="estado_egreso_presas" name="estado_egreso_presas" value="1">
                            <input type="hidden" id="estado_egresos" name="estado_egresos" value="1">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Liquidar</button>
                        @else

                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        @endif
                    </div>
                </form>
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

    <!-- Modal para DESECHOS -->
    <div class="modal fade" id="staticBackdrop3" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel3">Registro de Desechos</h5>
                </div>
                <form action="{{ route('egresos.desechos_lote_egresos') }}" method="post">
                    <div class="modal-body">
                       
                                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">

                                     <li class="nav-item">
                                        <a class="nav-link active" id="cant_animales-tab" data-toggle="tab" href="#cant_animales" role="tab"
                                            aria-controls="cant_animales" aria-selected="true">
                                            <h6 class="font-weight-bold">Cantidad {{ $lote->tipo }} <label id="cant_animales_egresos"></label></h6>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ahogados-tab" data-toggle="tab" href="#ahogados" role="tab"
                                            aria-controls="ahogados" aria-selected="false">
                                            <h6 class="font-weight-bold">Ahogados<label id="nombre_ahogados"></label></h6>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="estropeados-tab" data-toggle="tab" href="#estropeados" role="tab"
                                            aria-controls="estropeados" aria-selected="false">
                                            <h6 class="font-weight-bold">Estropeados<label id="nombre_estropeados"></label></h6>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="mollejas-tab" data-toggle="tab" href="#mollejas" role="tab"
                                            aria-controls="mollejas" aria-selected="false">
                                            <h6 class="font-weight-bold">Mollejas<label id="nombre_mollejas"></label></h6>
                                        </a>
                                    </li>

                              </ul>

                                <div class="tab-content" id="myTabContent">


                                <!-- Tab cantidad de animales  -->
                                <div class="tab-pane fade show active" id="cant_animales" role="tabpanel" aria-labelledby="cant_animales">
                                    <br>
                                    <div class="form-group">
                                            <label for="cant_animales">Cantidad total {{ $lote->tipo }} faenados *</label>
                                            <input type="number" class="form-control" id="cant_animales_egresos" name="cant_animales_egresos"
                                                value="{{ $lote->cant_animales_egresos }}" required />
                                    </div>
                                </div>

                                <!-- Tab animales Ahogados !-->
                                <div class="tab-pane fade" id="ahogados" role="tabpanel" aria-labelledby="ahogados">
                                    <br>
                                    <div class="form-group">
                                            <label for="cant_ahogados">Cantidad animales (ahogados) *</label>
                                            <input type="number" class="form-control" id="cant_ahogados_egresos" name="cant_ahogados_egresos"
                                                value="{{ old('cant_ahogados_egresos') }}" required />
                                    </div>

                                    <div class="form-group">
                                            <label for="peso_ahogados">Peso animales (ahogados) *</label>
                                            <input type="number" class="form-control" id="peso_ahogados_egresos" name="peso_ahogados_egresos"
                                                value="{{ old('peso_ahogados_egresos') }}" step=".01" required />
                                    </div>

                                     <div class="form-group">
                                            <label for="cant_gvacia_ahogados_egresos">Cantidad gavetas vacias (ahogados) *</label>
                                            <input type="number" class="form-control" id="cant_gvacia_ahogados_egresos" name="cant_gvacia_ahogados_egresos"
                                                value="{{ old('cant_gvacia_ahogados_egresos') }}" required />
                                    </div>


                                    <div class="form-group">
                                            <label for="peso_gvacia_ahogados_egresos">Peso gavetas vacias (ahogados) *</label>
                                            <input type="number" class="form-control" id="peso_gvacia_ahogados_egresos" name="peso_gvacia_ahogados_egresos"
                                                value="{{ old('peso_gvacia_ahogados_egresos') }}" step=".01" required />
                                    </div>

                                </div>


                                <!-- animales Estropeados !-->
                                <div class="tab-pane fade " id="estropeados" role="tabpanel" aria-labelledby="estropeados">
                                    <br>
                                    <div class="form-group">
                                            <label for="cant_estropeados">Cantidad animales (estropeados) *</label>
                                            <input type="number" class="form-control" id="cant_estropeados_egresos" name="cant_estropeados_egresos"
                                                value="{{ old('cant_estropeados_egresos') }}" required />
                                    </div>

                                    <div class="form-group">
                                            <label for="peso_estropeados">Peso animales (estropeados) *</label>
                                            <input type="number" class="form-control" id="peso_estropeados_egresos" name="peso_estropeados_egresos"
                                                value="{{ old('peso_estropeados_egresos') }}" step=".01" required />
                                    </div>

                                     <div class="form-group">
                                            <label for="cant_gvacia_estropeados">Cantidad gavetas vacias (estropeados) *</label>
                                            <input type="number" class="form-control" id="cant_gvacia_estropeados_egresos" name="cant_gvacia_estropeados_egresos"
                                                value="{{ old('cant_gvacia_estropeados_egresos') }}" required />
                                    </div>

                                    <div class="form-group">
                                            <label for="peso_gvacia_estropeados_egresos">Peso gavetas vacias (estropeados) *</label>
                                            <input type="number" class="form-control" id="peso_gvacia_estropeados_egresos" name="peso_gvacia_estropeados_egresos"
                                                value="{{ old('peso_gvacia_estropeados_egresos') }}" step= ".01" required />
                                    </div>

                                </div>

                                <!-- animales Mollejas !-->
                                <div class="tab-pane fade " id="mollejas" role="tabpanel" aria-labelledby="mollejas">
                                    <br>

                                    <div class="form-group">
                                        <label for="peso_mollejas">Peso bruto (mollejas) *</label>
                                        <input type="number" class="form-control" id="peso_mollejas_egresos" name="peso_mollejas_egresos"
                                                value="{{ old('peso_mollejas_egresos') }}" step=".01" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="peso_gvacia_mollejas">Peso gavetas vacias (mollejas) *</label>
                                        <input type="number" class="form-control" id="peso_gvacia_mollejas_egresos" name="peso_gvacia_mollejas_egresos"
                                                value="{{ old('peso_gvacia_mollejas_egresos') }}" step=".01" required />
                                    </div>

                                </div>
                            </div>
                                   
                    </div>
                    <div class="modal-footer">
                        @csrf                            
                            <input type="hidden" id="lotes_id" name="lotes_id" value="{{ $lote->id }}">
                            <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="{{ Auth::user()->username }}"
                                    required />
                            <input type="hidden" id="estado_egresos" name="estado_egresos" value="0">
                             <input type="hidden" id="estado_egreso_presas" name="estado_egreso_presas" value="0">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Grabar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para ANULAR GAVETAS VACÍAS -->
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

            /* $(".nav-tabs").on("click",function (e){
                e.preventDefault();

               var n = $("#nav-tabs").tabs("option","active");
               console.log(n);

               // $(".nav-link").removeClass("active")
                //$(".tab-pane").removeClass("show");

                $(this).addClass("active");
                $($(this).attr("href")).addClass("show");

               // console.log(0);
            });*/

            var ac_cant_gaveta = 0,
                ac_cant_gaveta_vacia = 0;

            var tbl_egresos = $("#tabla_egresos").length;
            var tbl_egresos_vacia = $("#tabla_egresos_gavetas").length;

            if (tbl_egresos === 0 || tbl_egresos_vacia === 0) {
                 $("#modal_liquidar").prop('disabled', true);
             }

            /*var columna = $("#tabla_egresos td:nth-child(6)").map(function() {
                return $(this).text();
            }).get();
            
            if (jQuery.inArray('0.00', columna) != -1 || $("table").length == 0) {
                $("#liquidar").prop('disabled', true);
            }*/

                            
            //cálculo de cantidad de gavetas x cantidad animales
            $('#registrar_peso').click(function(){
                var cant_gavetas = $('#cant_gavetas').val(); 
                var cant_animales = $('#cant_animales_pesos').val();
                var total_cant_animales = cant_gavetas * cant_animales; 
                $('#total_cant_animales').val(total_cant_animales);
               
            });
            
            

            $("#modal_liquidar").click(function() {
                $(".modal-title").html('¿Está seguro de liquidar el lote de egreso?');
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

        $(document).ready(function(){

            var id=$("#lotes_id").val();

             $("#modal-desechos").click(function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();


                 console.log(id);

                 $.ajax({
                    data: {
                        id: id
                    },
                    url: '/egresos/detalle_desechos',
                    type: 'post',
                    success: function(response){
                        $.each(response, function(index, value) {
                            $(".modal-title , #cant_ahogados_egresos").val(value.cant_ahogados_egresos);
                            $(".modal-title , #peso_ahogados_egresos").val(value.peso_ahogados_egresos);
                            $(".modal-title , #cant_gvacia_ahogados_egresos").val(value.cant_gvacia_ahogados_egresos);
                            $(".modal-title , #peso_gvacia_ahogados_egresos").val(value.peso_gvacia_ahogados_egresos);

                            $(".modal-title , #cant_estropeados_egresos").val(value.cant_estropeados_egresos);
                            $(".modal-title , #peso_estropeados_egresos").val(value.peso_estropeados_egresos);
                            $(".modal-title , #cant_gvacia_estropeados_egresos").val(value.cant_gvacia_estropeados_egresos);
                            $(".modal-title , #peso_gvacia_estropeados_egresos").val(value.peso_gvacia_estropeados_egresos);

                            $(".modal-title , #peso_mollejas_egresos").val(value.peso_mollejas_egresos);
                            $(".modal-title , #peso_gvacia_mollejas_egresos").val(value.peso_gvacia_mollejas_egresos);
                         })
                    },
                });
             });
        });

        $(document).ready(function() {
            setInterval(function() {
                $('#recargar').load('/egresos/seccion');
            }, 2000);

            setInterval(function() {
                $('#recargargve').load('/egresos/seccion_gvacia');
            }, 2000);

        });
    </script>

@endsection
