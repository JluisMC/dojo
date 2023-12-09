@extends('admin.templateStatic.template')

@section('title', 'Roles y Permisos')

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
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fas fa-user-cog"></i> Roles
            </h2>
            <ul>
                <li>
                    <a href="{{route('rolCreate')}}" >
                        <i class="fas fa-plus"></i> Agregar Nuevo
                    </a>
                </li>
            </ul>
        </div>

        <div class="inside">
            <div class="row">
                <div class="col-md-2 offset-md-10">
                </div>
            </div>
            <table class="table mtop16">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $r)
                        <tr>    
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->name }}</td>
                            <td>
                                <a href="{{ route('rolEdit', $r->id) }}" class="opts" data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
    
                                <a href="{{ route('permissionsEdit', $r->id) }}" class="opts" data-bs-toggle="tooltip" data-bs-title="Permisos de usuario">
                                    <i class="fa-solid fa-user-gear"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection