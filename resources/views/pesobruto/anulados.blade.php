@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Lotes - Peso en Bruto</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('pesobruto.index') }}" class="btn btn-primary">Volver Atrás</a>
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
                                                    <form action="{{ route('pesobruto.anular') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" id="id" name="id" value="{{ $lote->id }}">
                                                        <input type="hidden" id="anulado" name="anulado" value="0">
                                                        <button class="btn btn-sm btn-danger" type="submit">SI</button>
                                                    </form>
                                                </td>
                                            @endif
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
