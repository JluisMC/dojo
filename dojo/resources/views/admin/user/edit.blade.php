@extends('template.admin.master')
@section('title','Editar')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_index'))
    <a href="{{route('user_index')}}">
        <i class="fas fa-user"></i> Usuarios
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_edit'))
    <a href="{{route('user_edit', $user->id)}}">
        <i class="fas fa-edit"></i> Modificar usuario
    </a>
    @endif
</li>
@endsection

@section('content')
<div class="container-fluid">
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
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-edit"></i> Modificar usuario</h2>
        </div>
        <div class="inside">
            <form action="{{route('user_update', $user->id)}}" method="post">
            @method('put')
            @csrf
                <div class="header">
                    <h5>Datos de Usuario</h5>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="mtp-15">Usuario:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="mtp-15">Contraseña:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="password" name="password" class="form-control" value="{{$user->password}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="mtp-15">Rol:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                <select class="form-select" name="role_id" required>
                                    <option value="{{$user->role_id}}">{{$user->role->name}}</option>
                                    @foreach ($role as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-success mtp-40" value="Modificar datos de usuario">
                    </div>
                </div>
            </form>
            <form action="{{route('user_reset_password', $user->id)}}" method="post">
            @method('put')
            @csrf
                <div class="header mt-5">
                    <h5>Resetear contraseña</h5>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="mtp-15">Usuario:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}" readonly>
                            <input type="hidden" name="role_id" value="{{$user->role_id}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="mtp-15">Nueva Contraseña:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="password" name="password" class="form-control" placeholder="....." required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="mtp-15">Confirmar contraseña:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="password" name="cpassword" class="form-control" placeholder="....." required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-success mtp-40" value="Resetear contraseña">
                    </div>
                </div>
            </form>
            <form action="{{route('person_user_update', $user->person_id)}}" enctype="multipart/form-data" method="post">
            @method('put')
            @csrf
                <div class="header mt-5">
                    <h5>Datos Personales</h5>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="mtp-15">Nombres:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="text" name="name" class="form-control" value="{{$user->person->name}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="mtp-15">Apellidos:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="text" name="last_name" class="form-control" value="{{$user->person->last_name}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="mtp-15">Cédula de identidad:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="number" name="number_document" class="form-control" value="{{$user->person->number_document}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="mtp-15">Teléfono:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="number" name="phone" class="form-control" value="{{$user->person->phone}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="formFile" class="form-label mtp-15">Foto:</label>
                        <input class="form-control" type="file" name="avatar" id="formFile">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-success mt-5" value="Modificar datos personales">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
