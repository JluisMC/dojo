@extends('template.admin.master')
@section('title','Roles')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'role_index'))
    <a href="{{route('role_index')}}">
        <i class="fas fa-user-cog"></i> Roles
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
            <h2 class="title"><i class="fas fa-user-cog"></i> Roles</h2>
            <ul>
                <li>
                    @if (key_value_from_json(Auth::user()->permissions, 'role_create'))
                    <a href="{{route('role_create')}}" >
                        <i class="fas fa-plus"></i> Agregar Nuevo
                    </a>
                    @endif
                </li>
                <li>
                    <a href="#" id="btn_search">
                        <i class="fas fa-filter"></i> Filtrar / <i class="fas fa-search"></i> Buscar
                    </a>
                </li>
            </ul>
        </div>
        <div class="inside">
            <div class="form-search" id="form_search">
                <form action="{{route('role_index')}}" method="get">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="searchRole" id="searchRole" class="form-control" placeholder="Ingrese su busqueda">
                        </div>
                        <div class="col-md-4">
                            <select name="type" id="type" class="form-select">
                                <option selected value="">Seleccione el tipo de busqueda</option>
                                <option value="name">Nombre</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="filter" id="filter" class="form-select">
                                <option value="">Estados</option>
                                <option value="0">Activos</option>
                                <option value="1">Inactivos</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ROL</th>
                        <th>DESCRIPCION</th>
                        <th>FECHA DE CREACION</th>
                        <th>ESTADO</th>
                        @if (key_value_from_json(Auth::user()->permissions, 'role_edit'))
                            <th>OPCIONES</th>
                        @else
                            @if (key_value_from_json(Auth::user()->permissions, 'role_destroy'))
                            <th>OPCIONES</th>
                            @endif
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role as $r)
                        <tr>
                            <td>{{$r->id}}</td>
                            <td>{{$r->name}}</td>
                            <td>{{$r->description}}</td>
                            <td>{{$r->created_at}}</td>
                            @if ($r->status == 0)
                                <td>Inactivo</td>
                            @else
                                <td>Activo</td>
                            @endif
                            <td>
                                @if (key_value_from_json(Auth::user()->permissions, 'role_edit'))
                                    @if ($r->status == 1)
                                    <a href="{{route('role_edit', $r->id)}}" class="opts"
                                        data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                @endif
                                @if (key_value_from_json(Auth::user()->permissions, 'role_destroy'))
                                    @if ($r->status == 1)
                                    <a href="#" data-object="{{$r->id}}" data-action="destroy" data-path="dojo/public/admin/role"
                                        class="btn-destroy opts" data-toggle="tooltip" data-placement="top" title="Suspender">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    @else
                                    <a href="#" data-object="{{$r->id}}" data-action="restore" data-path="dojo/public/admin/role"
                                        class="btn-destroy opts" data-toggle="tooltip" data-placement="top" title="Activar">
                                        <i class="fas fa-trash-restore"></i>
                                    </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $role->render() !!}
        </div>
    </div>
</div>
@endsection
