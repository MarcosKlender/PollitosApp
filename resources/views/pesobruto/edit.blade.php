@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header mt-2 text-center">
                    <h4>Registro de Pesos - Lote {{ $lote->id }} </h4>
                </div>
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
                    <form method="post" action="{{ route('pesobruto.update', $lote->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="cant_gavetas">Cantidad de Gavetas</label>
                                <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                    value="{{ old('cant_gavetas') }}" required autofocus />
                            </div>
                            <!-- <div class="form-group col-lg-6">
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" class="custom-control-input" id="check_pollos"
                                        name="check_pollos">
                                    <label class="custom-control-label" for="check_pollos">Cantidad de Pollos</label>
                                </div>
                                <input type="number" class="form-control" id="cant_pollos" name="cant_pollos"
                                    value="{{ old('cant_pollos') }}" disabled />
                            </div> -->
                            <div class="form-group col-lg-6">
                                <label for="peso_bruto">Peso Bruto</label>
                                <input type="number" class="form-control" id="peso_bruto"
                                    name="peso_bruto" value="{{ old('peso_bruto') }}" step=".01" required />
                            </div>
                        </div>
                        <input type="hidden" id="lotes_id" name="lotes_id" value="{{ $lote->id }}">
                        <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->username }}" required />
                        <input type="hidden" id="anulado" name="anulado" value="0" required />
                        <div class="row justify-content-around">
                            <a href="{{ route('pesobruto.index') }}" class="btn btn-primary">Volver Atrás</a>
                            <button type="submit" class="btn btn-success">Registrar Peso</button>
                        </div>
                    </form>

                    @if (count($registros) != 0)
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>ID Lote</td>
                                        <td>Cantidad de Gavetas</td>
                                        <!-- <td>Cantidad {{ $lote->tipo }}</td> -->
                                        <td>Peso Bruto</td>
                                        <td>Peso Gavetas</td>
                                        <td>Peso {{ $lote->tipo }}</td>
                                        <td>Usuario</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                        <tr>
                                            <td>{{ $registro->id }}</td>
                                            <td>{{ $registro->lotes_id }}</td>
                                            <td>{{ $registro->cant_gavetas }}</td>
                                            <!-- @if ($registro->cant_pollos == null) <td>N/A</td> @else <td>{{ $registro->cant_pollos }}</td> @endif -->
                                            <td class="tdbruto" value="{{ $registro->peso_bruto }}">{{ $registro->peso_bruto }}</td>
                                            <td>{{ $registro->peso_gavetas }}</td>
                                            <td>{{ $registro->peso_final }}</td>
                                            <td>{{ $registro->usuario }}</td>
                                            <td><button type="button" class="btn btn-sm btn-primary modal_gavetas" data-toggle="modal" data-target="#staticBackdrop1" data-id="{{ $registro->id }}" data-peso-bruto="{{ $registro->peso_bruto }}">Gavetas</button>
                                            <button type="button" class="btn btn-sm btn-danger modal_anular" data-toggle="modal" data-target="#staticBackdrop2" data-id="{{ $registro->id }}">Anular</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Gavetas -->
    <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel1">Registrar Peso de Gavetas</h5>
                </div>

                <form action="{{ route('pesobruto.registrar_gavetas') }}" method="post">
                @csrf
                    <div class="modal-body">
                        <input type="number" class="form-control" id="peso_gavetas" name="peso_gavetas" step=".01" required />
                    </div>
                    <div class="modal-footer">
                            <input type="hidden" id="id_gavetas" name="id_gavetas">
                            <input type="hidden" id="peso_final" name="peso_final">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="supersubmit" class="btn btn-success">Registrar Peso</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal para Anular -->
    <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel2">¿Está seguro de anular el registro?</h5>
                </div>
                <div class="modal-body">
                    Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <form action="{{ route('pesobruto.anular_registro') }}" method="post">
                        @csrf
                        <input type="hidden" id="id_anular" name="id_anular">
                        <input type="hidden" id="anulado" name="anulado" value="1">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Anular</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".modal_gavetas").click(function() {
                var registro_g = $(this).attr('data-id');
                $("#id_gavetas").val(registro_g);
                var peso_bruto = parseFloat($(this).attr('data-peso-bruto')).toFixed(2);

                $("#supersubmit").click(function() {
                    var peso_gavetas = parseFloat($("#peso_gavetas").val()).toFixed(2);
                    var peso_final = parseFloat(peso_bruto - peso_gavetas).toFixed(2);
                    $("#peso_final").val(peso_final);
                });
            });

            $(".modal_anular").click(function() {
                var registro_a = $(this).attr('data-id');
                $("#id_anular").val(registro_a);
            });
        });
    </script>

@endsection
