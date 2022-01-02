@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>GAVETAS ANULADAS - EGRESOS</h4>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row justify-content-around">
                        <div class="mb-3">
                            <a href="{{ route('egresos.index') }}" class="btn btn-primary">Volver Atrás</a>
                        </div>
                    </div>

                    @if ($count == 0)
                        <div class="alert alert-danger">No se han encontrado gavetas anuladas.</div>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>ID Registro</td>
                                        <td>ID Lote</td>
                                        <td>Cantidad Gavetas Vacías</td>
                                        <td>Peso Gavetas Vacías</td>
                                        <td>Tipo Peso</td>
                                        <td>Usuario</td>
                                        <td>Observaciones</td>
                                        <td>Fecha de Anulación</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gavetas as $gaveta)
                                        <tr>
                                            <td>{{ $gaveta->id }}</td>
                                            <td>{{ $gaveta->lotes_id }}</td>
                                            <td>{{ $gaveta->cant_gavetas_vacias }}</td>
                                            <td>{{ $gaveta->peso_gavetas_vacias }}</td>
                                            <td>{{ $gaveta->tipo_peso }}</td>
                                            <td>{{ $gaveta->usuario }}</td>
                                            <td>{{ $gaveta->observaciones }}</td>
                                            <td>{{ $gaveta->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    <div class="row justify-content-around">
                        {{ $gavetas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
