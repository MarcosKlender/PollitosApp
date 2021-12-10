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
                                <tr>
                                    <td>N°</td>
                                    <td>Tipo Animal</td>
                                    <td>Cliente</td>
                                    <td>RUC/CI</td>
                                    <td>Placa</td>
                                    <td>Conductor</td>
                                    <td>Peso</td>
                                    <td>Usuario</td>
                                    <td>Fecha de Registro</td>
                                    @if (Auth::user()->rol->key == 'admin')
                                        <td>Anulado</td>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entregas as $entrega)
                                    <tr>
                                        <td>{{$loop->iteration  }} </td> 
                                        <td>{{ $entrega->tipo }}</td>
                                        <td>{{ $entrega->cliente }}</td>
                                        <td>{{ $entrega->ruc_ci }}</td>
                                        <td>{{ $entrega->placa }}</td>
                                        <td>{{ $entrega->conductor }}</td>
                                        <td>{{ $entrega->peso_entrega }}</td>
                                        <td>{{ $entrega->usuario }}</td>
                                        <td>{{ $entrega->created_at }}</td>    
                                        @if (Auth::user()->rol->key == 'admin')
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary modal_anular"
                                                    data-toggle="modal" data-id="{{ $entrega->id }}"
                                                    data-target="#staticBackdrop1">NO</button>
                                            </td>
                                        @endif
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
