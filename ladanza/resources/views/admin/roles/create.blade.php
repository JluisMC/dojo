@extends('admin.templateStatic.template')
@section('title','Roles')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="#">
        <i class="fas fa-cog"></i> Componentes
    </a>
</li>
<li class="breadcrumb-item">
    <a href="#">
        <i class="fas fa-user-cog"></i> Roles
    </a>
</li>
<li class="breadcrumb-item">
    <a href="#">
        <i class="fas fa-plus"></i> Registrar Rol
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
                        <h2 class="title"><i class="fas fa-plus"></i> Registrar Rol</h2>
                    </div>
                    <div class="inside">
                        <form action="{{route('rolesStore')}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label_ini">Nombre:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <input type="submit" class="btn btn-success mt-4" value="Completado">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="label_ini">Descripción:</label>
                                    <textarea name="description" id="" cols="90" rows="3" class="form-control"></textarea>
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
