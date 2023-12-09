@extends('admin.templateStatic.template')
@section('title','Permisos')

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
        <i class="fa-solid fa-gears"></i> Asignacion de permisos, Rol : {{$rol->name}}
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="page-user">
        <form action="{{route('permissionsUpdate', $rol->id)}}" method="POST">
        @method('put')
        @csrf
            <div class="row">
                @include('admin/roles/permissions/module_dashboard')
                @include('admin/roles/permissions/module_person')
                @include('admin/roles/permissions/module_address')
                @include('admin/roles/permissions/module_user')
            </div>
            <div class="row mt-2">
                @include('admin/roles/permissions/module_roles')
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="panel shadow">
                        <div class="inside">
                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <input type="submit" value="Guardar" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
   </div>
</div>
@endsection
