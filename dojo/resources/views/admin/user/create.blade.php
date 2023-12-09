@extends('template.admin.master')
@section('title','Registro')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_index'))
    <a href="{{route('user_index')}}">
        <i class="fas fa-user"></i> Usuarios
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_create'))
    <a href="{{route('user_create', $person->id)}}">
        <i class="fas fa-plus"></i> Registrar usuario
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
                        <h2 class="title"><i class="fas fa-plus"></i>  Foto del cliente</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                        @if (is_null($person->avatar))
                            <img src="{{url('styles/images/default_avatar.png')}}" class="avatar" >
                        @else
                            <a href="{{url('/uploads/'.$person->fileImage.'/'.$person->avatar)}}" data-fancybox="gallery">
                                <img src="{{url('/uploads/'.$person->fileImage.'/'.$person->avatar)}}" class="avatar">
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Datos personales</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label_ini">Nombres:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" class="form-control"value="{{$person->name}}" readonly>
                                </div>
                                <label>Apellidos:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" class="form-control"value="{{$person->last_name}}" readonly>
                                </div>
                                <label>Cédula de identidad:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" class="form-control"value="{{$person->number_document}}" readonly>
                                </div>
                                <label>Teléfono:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" class="form-control"value="{{$person->phone}}" readonly>
                                </div>
                                <label for="formFile" class="form-label">Foto:</label>
                                <input class="form-control" type="file" name="avatar" id="formFile" disabled>
                                <input type="submit" value="Completado" class="btn btn-success mt-3 disabled">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Datos de usuario</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <form action="{{route('user_store')}}" method="post">
                            @csrf
                                <div class="col-md-12">
                                    <label class="label_ini">Correo Electrónico:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="email" name="email" class="form-control" placeholder="....." required>
                                        <input type="hidden" name="person_id" value="{{$person->id}}">
                                    </div>
                                    <label>Contraseña:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="password" name="password" class="form-control" placeholder="....." required>
                                    </div>
                                    <label>Confirmar contraseña:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="password" name="cpassword" class="form-control" placeholder="....." required>
                                    </div>
                                    <label>Rol:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <select class="form-select" name="role_id" required>
                                            <option selected hidden value="">Seleccione un rol</option>
                                            <option value="1">Propietario</option>
                                            <option value="2">Encargado de negocio</option>
                                            <option value="3">Administrador</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="Completado" class="btn btn-success mt-3">
                                <div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
