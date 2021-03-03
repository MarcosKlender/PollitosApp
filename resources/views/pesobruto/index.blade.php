@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>PESO BRUTO</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('pesobruto.create') }}" class="btn btn-success">Crear Registro</a>
                        </div>
                        @if (Auth::user()->rol->key == 'admin')
                            <div class="mb-3">
                                <a href="{{ route('pesobruto.lotes_anulados') }}" class="btn btn-danger">Lotes
                                    Anulados</a>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('pesobruto.registros_anulados') }}" class="btn btn-danger">Registros
                                    Anulados</a>
                            </div>
                        @endif
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
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Tipo</td>
                                        <td>Cantidad</td>
                                        <td>Proveedor</td>
                                        <td>RUC/CI</td>
                                        <td>Procedencia</td>
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                         @if(Auth::user()->rol->key == 'admin')   
                                                <td>Usuario</td>
                                         @endif       
                                        <td>Fecha de Registro</td>
                                        @if (Auth::user()->rol->key == 'admin')
                                            <td>Anulado</td>
                                        @endif
                                        <td>Liquidado</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lotes as $lote)
                                        <tr>
                                            <td>{{ $lote->id }}</td>
                                            <td>{{ $lote->tipo }}</td>
                                            <td>{{ $lote->cantidad }}</td>
                                            <td>{{ $lote->proveedor }}</td>
                                            <td>{{ $lote->ruc_ci }}</td>
                                            <td>{{ $lote->procedencia }}</td>
                                            <td>{{ $lote->placa }}</td>
                                            <td>{{ $lote->conductor }}</td>
                                             @if(Auth::user()->rol->key == 'admin')   
                                                <td>{{ $lote->usuario }}</td>
                                             @endif   
                                            <td>{{ $lote->created_at }}</td>
                                            @if (Auth::user()->rol->key == 'admin')
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary modal_anular" data-toggle="modal"
                                                        data-id="{{ $lote->id }}" data-target="#staticBackdrop1">NO</button>
                                                </td>
                                            @endif
                                            <td>
                                                @if ($lote->liquidado == '0')
                                                    <button type="button" class="btn btn-sm btn-primary">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success">SI</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($lote->liquidado == '0')
                                                    <a href="{{ route('pesobruto.edit', $lote->id) }}"
                                                        class="btn btn-sm btn-primary">Registrar Pesos</a>
                                                @else
                                                    <a href="{{ route('pesobruto.show', $lote->id) }}"
                                                        class="btn btn-sm btn-success">Ver Pesos</a>
                                                @endif
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
                    <h5 class="modal-title" id="staticBackdropLabel1"></h5>
                </div>
                <div class="modal-body">
                    Esta acción no se puede deshacer. <br><br>

                    <form action="{{ route('pesobruto.anular_lote') }}" method="post">
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
                var lote_a = $(this).attr('data-id');
                $(".modal-title").html('¿Está seguro de anular el Lote #' + lote_a + '?');
                $("#id_anular").val(lote_a);
            });
        });

    </script>

@endsection
