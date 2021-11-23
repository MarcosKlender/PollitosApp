@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <!--script src="https://code.jquery.com/jquery-3.2.1.js"></script!-->
    <!--link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css"!-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!--style>
        .container {
            max-width: 500px;
        }
        h2 {
            color: white;
        }
    </style!-->

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
                 <!--body class="bg-primary"!-->
                    <!--div class="container mt-5"!-->
                    
                        

                        <!--div class="mb-6"!-->
                            <form method="POST" action="{{ route('basculas.store') }}">
                            @csrf
                                <!--div class="input-group-prependt-group"!-->
                                    <!--div class="input-group-prepend"!-->
                                        <select class="form-control" id="id" name="id" required onchange= "javascript:prueba()">
                                            <option value="" selected disabled>Seleccione una báscula</option>
                                            <option value="B001">Báscula 1</option>
                                            <option value="B002">Báscula 2</option>
                                            </select>
                                    <!--/div!-->
                                <!--/div!-->
                                <br>
                                    <div>
                                        <select class="nom_user form-control" id="nom_user" name="nom_user" required></select>
                                    </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        <!--/div!-->
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


                <!--/body!-->
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
