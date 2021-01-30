@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Peso en Bruto</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('pesobruto.create') }}" class="btn btn-success">Crear Registro</a>
                        </div>
                        @if (Auth::user()->rol->key == 'admin')
                            <div class="mb-3">
                                <a href="{{ route('pesobruto.lotes_anulados') }}" class="btn btn-danger">Lotes Anulados</a>
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
                                        <td>Proveedor</td>
                                        <td>Procedencia</td>
                                        <td>Placa</td>
                                        <td>Conductor</td>
                                        <td>Usuario</td>
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
                                            <td>{{ $lote->proveedor }}</td>
                                            <td>{{ $lote->procedencia }}</td>
                                            <td>{{ $lote->placa }}</td>
                                            <td>{{ $lote->conductor }}</td>
                                            <td>{{ $lote->usuario }}</td>
                                            <td>{{ $lote->created_at }}</td>
                                            @if (Auth::user()->rol->key == 'admin')
                                                <td>
                                                    <form action="{{ route('pesobruto.anular_lote') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" id="id" name="id" value="{{ $lote->id }}">
                                                        <input type="hidden" id="anulado" name="anulado" value="1">
                                                        <button class="btn btn-sm btn-primary" type="submit">NO</button>
                                                    </form>
                                                </td>
                                            @endif
                                            <td>
                                                @if ($lote->liquidado == '0')
                                                    <button type="button" class="btn btn-sm btn-primary">NO</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-primary">SI</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($lote->liquidado == '0')
                                                    <a href="{{ route('pesobruto.edit', $lote->id) }}"
                                                        class="btn btn-sm btn-primary">Registrar Pesos</a>
                                                @else
                                                    <a href="{{ route('pesobruto.show', $lote->id) }}"
                                                        class="btn btn-sm btn-primary">Ver Pesos</a>
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
                            <b>{{ $count }}</b></span>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
