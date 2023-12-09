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
                            <img src="{{url('static/images/default-avatar.png')}}" class="avatar" >
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
                            <form action="{{route('personUserStore')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <label class="label_ini">Nombres:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="....." required>
                                        <input type="hidden" name="type_person" value="usuario">
                                    </div>
                                    <label>Apellidos:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="....." required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>N° documento:</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                                <input type="number" name="number_document" value="{{old('number_document')}}" class="form-control" placeholder="....." required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Extension:</label>
                                            <div class="input-group">
                                                <select name="extension" class="form-select" required>
                                                    <option disabled selected>Ext</option>
                                                    @foreach (extension_document() as $ed)
                                                        <option value="{{$ed}}">{{$ed}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Teléfono:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="number" name="phone" value="{{old('phone')}}" class="form-control" placeholder="....." required>
                                    </div>
                                    <label for="formFile" class="form-label">Foto:</label>
                                    <input class="form-control" type="file" name="avatar" id="formFile" required>
                                    <input type="submit" value="Completado" class="btn btn-success mt-3">
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
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label_ini">Correo electrónico:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="email" class="form-control" disabled>
                                </div>
                                <label>Contraseña:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="password" class="form-control" disabled>
                                </div>
                                <label>Confirmar Contraseña:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="password" class="form-control" disabled>
                                </div>
                                <label>Asignar Rol:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select name="rol" class="form-control" disabled>
                                        <option>Seleccionar rol</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="submit" value="Generar datos" class="btn btn-success width100 mt-3 disabled">
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
