@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
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
                            <input type="hidden" id="lotes_id" name="lotes_id" value="{{ $lote->id }}">
                            <div class="form-group col-lg-6">
                                <label for="cant_gavetas">Cantidad de Gavetas</label>
                                <input type="number" class="form-control" id="cant_gavetas" name="cant_gavetas"
                                    value="{{ old('cant_gavetas') }}" required />
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="cant_pollos">Cantidad de Pollos</label>
                                <input type="number" class="form-control" id="cant_pollos" name="cant_pollos"
                                    value="{{ old('cant_pollos') }}" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="peso_gavetas_pollos">Peso de Gavetas + Pollos</label>
                                <input type="number" class="form-control" id="peso_gavetas_pollos" name="peso_gavetas_pollos"
                                    value="{{ old('peso_gavetas_pollos') }}" maxlength="7" required />
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="peso_gavetas">Peso de Gavetas</label>
                                <input type="number" class="form-control" id="peso_gavetas" name="peso_gavetas"
                                    value="{{ old('peso_gavetas') }}" required />
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="peso_final">Peso Final</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="peso_final" name="peso_final" required readonly>
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-primary" id="calcular_peso_final" name="calcular_peso_final">Calcular</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-around">
                            <a href="{{ route('pesobruto.index') }}" class="btn btn-danger">Cancelar</a>
                            {{-- <a href="#" class="btn btn-primary">Añadir</a> --}}
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>

                    @if (isset($registros))
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>ID Lote</td>
                                    <td>Cantidad Gavetas</td>
                                    <td>Cantidad Pollos</td>
                                    <td>Peso G+P</td>
                                    <td>Peso G</td>
                                    <td>Peso Final</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registros as $registro)
                                <tr>
                                    <td>{{ $registro->lotes_id }}</td>
                                    <td>{{ $registro->cant_gavetas }}</td>
                                    <td>{{ $registro->cant_pollos }}</td>
                                    <td>{{ $registro->peso_gavetas_pollos }}</td>
                                    <td>{{ $registro->peso_gavetas }}</td>
                                    <td>{{ $registro->peso_final }}</td>
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#calcular_peso_final").click(function() {
                var peso_gp = parseFloat($("#peso_gavetas_pollos").val());
                var peso_g = parseFloat($("#peso_gavetas").val());
                var peso_f = peso_gp - peso_g;
                $("#peso_final").val(peso_f).toFixed(2);
            });
        });

    </script>

@endsection
