@extends('template.admin.login')
@section('title','Login')
@section('content')

<div class="box box_login shadow">
    <div class="header">
        <a href="{{url('/')}}">
            <img src="{{url('/styles/images/logo.jpg')}}">
        </a>
    </div>
    <div class="inside">
        <form action="{{route('login_store')}}" method="post">
        @csrf
            <label for="email">Correo electrónico:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                <input type="text" id="email" name="email" class="form-control" placeholder="....." required>
            </div>

            <label for="password" class="mtop16">Password:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                <input type="password" id="password" name="password" class="form-control" placeholder="....." required>
            </div>
            <div class="row mt-2">
                <div class="col-4 mx-auto">
                    <input type="submit" class="btn btn-primary w-100" value="Entrar">
                </div>
            </div>
        </form>

        @if (Session::has('message'))
        <div class=" alert mt-3 alert-{{ Session::get('typealert')}}" style="display:none;">
            {{Session::get('message')}}
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            <script>
                $('.alert').slideDown();
                setTimeout(function(){$('.alert').slideUp();}, 5000);
            </script>
        </div>
        @endif

        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 center">
                {{-- <a href="#">Recuperar contraseña</a> --}}
            </div>
        </div>

    </div>
</div>
@stop

