@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- switch botton !-->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


<div class="row justify-content-center">
    <div class="col-lg-11">
         <div class="card shadow mb-4">
            <div class="card-header mt-2">
                    <div class="text-center">
                        <h4>Administración de Básculas</h4>
                    </div>
            </div>

              <div class="card-body">
                <div class="row justify-content-center">

                            <!--form method="POST" action=""!-->
                            <form method="POST" action="{{ route('basculas.store') }}">
                            @csrf
                                        <select class="form-control" id="id" name="id" required onchange= "javascript:prueba()">
                                            <option value="" selected disabled>Seleccione una báscula</option>
                                            <option value="B001">Báscula 1</option>
                                            <option value="B002">Báscula 2</option>
                                            </select>
                                <br>
                                    <div>
                                        <select class="nom_user form-control" id="nom_user" name="nom_user" required></select>
                                    </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                    </div>

                    <br>
                        @if($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        </div>
                        @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead >
                                <tr>
                                    <th>#</th>
                                    <th>ID Báscula</th>
                                    <th>Usuario</th>
                                    <th>Automático</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($basculas as $bascula)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$bascula->id}}</td>
                                    <td>{{$bascula->nom_user}}</td>
                                    <td> 
                                        <div class="form-check pl-0">
                                            <input class="check-sw" type="checkbox" data-id="{{$bascula->id}}" name="staticBackdrop{{$loop->iteration}}" data-toggle="modal" data-onstyle="outline-success" data-offstyle="outline-danger" data-target="#staticBackdrop1" value="{{$bascula->automatico}}">
                                        </div>
                                    </td>
                                    <td>
                                        <form method="post" action="{{url('/basculas/'.$bascula->id)}}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('¿Desea eliminar?');">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Bascula automático !-->
    <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel1"></h5>
                </div>
                <div class="modal-body">
                   
                    <form method="post" action="">
                        @csrf
                        @method('PATCH')
                        <input type="text" id="id_bascula" name="id_bascula" value="">
                        <input type="text" id="automatico" name="automatico" value="">
                        <button type="button" id="btn_cancelar" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Grabar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $('.nom_user').select2({
        placeholder: 'Seleccione el usuario',
        ajax: {
            url: '/ajax-autocomplete-search2',
            dataType: 'json',
            delay: 5,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.username,
                            id: item.username,
                            value: item.username
                        }
                    })
                };
            },
            cache: true
        }
    });



   

</script>
@endsection
