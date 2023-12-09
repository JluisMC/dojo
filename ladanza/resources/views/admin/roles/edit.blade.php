@extends('admin.templateStatic.template')
@section('title','Roles')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="#">
        <i class="fas fa-cog"></i> Componentes
    </a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('rolesIndex') }}">
        <i class="fas fa-user-cog"></i> Roles
    </a>
</li>
<li class="breadcrumb-item">
    <a href="#">
        <i class="fa-solid fa-pen-to-square"></i> Editar Rol
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-user">
        <div class="row">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar Rol</h2>
                    </div>
                    <div class="inside">
                        <form action="{{ route('rolUpdate', $rol->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label_ini">Nombre:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="name" value="{{ $rol->name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-warning-border-subtle mt-4" value="Modificar">
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('rolesIndex') }}" class="btn btn-primary mt-4">Salir</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="label_ini">Descripción:</label>
                                    <textarea name="description" id="" cols="90" rows="3" class="form-control">{{ $rol->description}}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
