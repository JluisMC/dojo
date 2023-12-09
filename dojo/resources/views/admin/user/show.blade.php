@extends('template.admin.master')
@section('title','Detalle')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_index'))
    <a href="{{route('user_index')}}">
        <i class="fas fa-user"></i> Usuarios
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_show'))
    <a href="{{route('user_show', $user->id)}}">
        <i class="fas fa-info-circle"></i> Detalle del Usuario
    </a>
    @endif

</li>
@endsection

@section('content')
<div class="container-fluid">
    @if (Session::has('message'))
    <div class=" alert mt-4 alert-{{ Session::get('typealert')}}" style="display:none;">
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
    <div class="page_user_show">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i>  Foto del usuario</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                        @if (is_null($user->person->avatar))
                            <img src="{{url('styles/images/default_avatar.png')}}" class="avatar" >
                        @else
                            <a href="{{url('/uploads/'.$user->person->fileImage.'/'.$user->person->avatar)}}" data-fancybox="gallery">
                                <img src="{{url('/uploads/'.$user->person->fileImage.'/'.$user->person->avatar)}}" class="avatar">
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i>  Datos personales</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label_ini">Nombres:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" value="{{$user->person->name}}" class="form-control" readonly>
                                </div>
                                <label>Apellidos:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" value="{{$user->person->last_name}}" class="form-control" readonly>
                                </div>
                                <label>Cédula de identidad:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" value="{{$user->person->number_document}}" class="form-control" readonly>
                                </div>
                                <label>Teléfono:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" value="{{$user->person->phone}}" class="form-control" readonly>
                                </div>
                                <label for="formFile" class="form-label">Foto:</label>
                                <input class="form-control" type="file" name="avatar" id="formFile" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i>  Datos de usuario</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label_ini">Usuario:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="email" value="{{$user->email}}" class="form-control" readonly>
                                </div>
                                <label>Contraseña:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="password" value="{{$user->password}}" class="form-control" readonly>
                                </div>
                                <label>Rol:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    @switch($user->role_id)
                                        @case(1)
                                            <input type="text" value="Propietario" class="form-control" readonly>
                                            @break
                                        @case(2)
                                            <input type="text" value="Encargado de Negocio" class="form-control" readonly>
                                            @break
                                        @case(3)
                                            <input type="text" value="Administrador" class="form-control" readonly>
                                            @break
                                    @endswitch
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
