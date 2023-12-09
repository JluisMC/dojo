@extends('login.template')

@section('title','Login')

@section('content')
<div class="box box_login shadow">
    <div class="header">
        <a>
            <img src="{{asset('/static/images/logo.png')}}" alt="">
        </a>
    </div>
    <div class="inside">
        <form action="{{ route('loginStore') }}" method="POST">
        @csrf
            <label>Correo Electrónico:</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-envelope"></i></span>
                <input type="email" value="{{old('email')}}" name="email" class="form-control" >
            </div>

            <label>Contraseña:</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                <input type="password" value="{{old('password')}}" name="password" class="form-control" >
            </div>

            <input type="submit" value="Ingresar" class="btn btn-success">
        </form>

        @if (Session::has('message'))
            <div class="container">
                <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display: none;">
                    {{ Session::get('message') }}
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    <script>
                        $('.alert').slideDown();
                        setTimeout(function(){$('.alert').slideUp();},10000);
                    </script>
                </div>
            </div>
        @endif

        <div class="footer mtop16">
            {{-- <a href="{{ route('login.create') }}" class="href">Registrarse</a> --}}
            {{-- <a href="{{route('recover')}}" class="href">Recuperar contraseña</a> --}}
        </div>
    </div>
</div>
@stop

    

