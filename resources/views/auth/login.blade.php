@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('LOGIN') }}</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('Correo Electrónico') }}" value="{{ old('email') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Contaseña') }}" required>
                                    </div>

                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">{{ __('Recuérdame') }}</label>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Iniciar Sesión') }}
                                        </button>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw mr-1"></i> {{ __('Iniciar Sesión con Facebook') }}
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-twitter btn-user btn-block">
                                            <i class="fab fa-twitter fa-fw mr-1"></i> {{ __('Iniciar Sesión con Twitter') }}
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw mr-1"></i> {{ __('Iniciar Sesión con Gmail') }}
                                        </button>
                                    </div>

                                </form>

                                <hr>

                                @if (Route::has('password.request'))
                                    <div class="text-center mb-3">
                                        <a class="small" href="{{ route('password.request') }}">
                                            {{ __('Olvidé mi contraseña') }}
                                        </a>
                                    </div>
                                @endif
                                
                                @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">{{ __('¿No tienes una cuenta? ¡Regístrate!') }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
