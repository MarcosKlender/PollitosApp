@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>ENTREGAS</h4>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('entregas.create') }}" class="btn btn-success">Registrar Entrega</a>
                        </div>

                        @if (Auth::user()->rol->key == 'admin')
                            <div class="mb-3">
                                <a href="{{ route('entregas.entregas_anuladas') }}" class="btn btn-danger">Entregas
                                    Anuladas</a>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('entregas.registros_anulados') }}" class="btn btn-danger">Registros Anulados</a>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('entregas.presas_anuladas') }}" class="btn btn-danger">Presas
                                    Anuladas</a>
                            </div>
                        @endif
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
                                        <td>Usuario creación</td>
                                        <td>Fecha creación</td>
                                        @if (Auth::user()->rol->key == 'admin')
                                            <td>Anulado</td>
                                        @endif
                                        <td>Liquidado</td>
                                        <td>Acciones</td>
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
                                            <td>{{ $entrega->usuario_creacion }}</td>
                                            <td>{{ $entrega->created_at }}</td>
                                            @if (Auth::user()->rol->key == 'admin')
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary modal_anular"
                                                        data-toggle="modal" data-id="{{ $entrega->id }}"
                                                        data-target="#staticBackdrop1">NO</button>
                                                </td>
                                            @endif
                                            <td>
                                                @if ($entrega->liquidado == '0')
                                                    <button type="button" class="btn btn-sm btn-primary">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success">SI</button>
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if ($entrega->liquidado == '0')
                                                    <a href="{{ route('entregas.edit', $entrega->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fas fa-plus-square"></i></a>
                                                @else
                                                    <a href="{{ route('entregas.show', $entrega->id) }}"
                                                        ><i class="text-success fas fa-eye fa-2x"></i> </a>
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
                        {{-- <span>Total de Usuarios: <b>{{ $count }}</b></span> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ANULAR -->
    <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel1">¿Está seguro de anular esta entrega?</h5>
                </div>
                <div class="modal-body">
                    Esta acción no se puede deshacer. <br><br>

                    <form action="{{ route('entregas.anular_entrega') }}" method="post">
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".modal_anular").click(function() {
                var entrega_a = $(this).attr('data-id');
                $("#id_anular").val(entrega_a);
            });
        });
    </script>

@endsection
