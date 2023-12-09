@extends('admin.templateStatic.template')
@section('title','Registro de datos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('userIndex') }}">
        <i class="fas fa-users"></i> Usuarios
    </a>
</li>
<li class="breadcrumb-item">
    <a href="#">
        <i class="fas fa-plus"></i> Registrar usuario
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user_show">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Foto de la persona</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                        @if (is_null($person->avatar))
                            <img src="{{url('styles/images/default_avatar.png')}}" class="avatar" >
                        @else
                            <a href="{{url('/uploads/'.$person->file_image.'/'.$person->avatar)}}" data-fancybox="gallery">
                                <img src="{{url('/uploads/'.$person->file_image.'/'.$person->avatar)}}" class="avatar">
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
                            <form action="#" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <label class="label_ini">Nombres:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" value="{{$person->name}}" class="form-control" disabled>
                                        <input type="hidden" name="type_person" value="usuario">
                                    </div>
                                    <label>Apellidos:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" value="{{$person->last_name}}" class="form-control" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>N° documento:</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                                <input type="number" value="{{$person->number_document}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Extension:</label>
                                            <div class="input-group">
                                                <input type="text" value="{{$person->extension}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Teléfono:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="number" value="{{$person->phone}}" class="form-control" disabled>
                                    </div>
                                    <label for="formFile" class="form-label">Foto:</label>
                                    <input class="form-control" type="file" name="avatar" id="formFile" disabled>
                                    <input type="submit" value="Completado" class="btn btn-success mt-2" disabled>
                                </div>
                            </form>

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
                        <form action="{{route('userStore')}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="label_ini">Correo electrónico:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" >
                                        <input type="hidden" name="person_id" value="{{$person->id}}">
                                    </div>
                                    <label>Contraseña:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="password" name="password" value="{{old('password')}}" class="form-control" >
                                    </div>
                                    <label>Confirmar Contraseña:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="password" name="cpassword" value="{{old('cpassword')}}" class="form-control" >
                                    </div>
                                    <label>Asignar Rol:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <select name="rol" class="form-select">
                                            <option disabled selected>Seleccionar rol</option>
                                            @foreach ($rol as $r)
                                                <option value="{{$r->id}}">{{$r->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <input type="submit" value="Generar datos" class="btn btn-success width100 mt-3">
                                    </div>
                                <div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
