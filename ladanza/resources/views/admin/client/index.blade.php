@extends('admin.templateStatic.template')

@section('title', 'Clientes')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="#">
        <i class="fa-solid fa-users"></i> Clientes
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fa-solid fa-users"></i> Clientes
            </h2>
        </div>

        <div class="inside">
            <div class="row">
                <div class="col-md-3">
                    <div class="button">
                        <a href="{{route('person.create')}}" class="btn btn-primary">Nuevo cliente</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 offset-md-10">
                    {{-- <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                            <i class="fa-solid fa-filter"></i> Filtro
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('users',$status=1) }}"><i class="fa-solid fa-user-check"></i> Activos</a>
                          <a class="dropdown-item" href="{{ route('users', $status=0) }}"><i class="fa-solid fa-user-minus"></i> Inactivo</a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <hr>
            <table class="table mtop16">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>EMAIL</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ getRoleArrayKey(null, $user->role) }}</td>
                        <td>{{ getStatusArrayKey(null, $user->status) }}</td>
                        <td>
                            <div class="opts">
                                <a href="{{ route('user.edit', $user->id)}}">
                                    <i class="fa-solid fa-pen-to-square" data-toggle="tooltip" data-placement="top" title="Editar"></i>
                                </a>
                                <a href="{{ route('user_permissions', $user->id) }}">
                                    <i class="fa-solid fa-user-gear" data-toggle="tooltip" data-placement="top" title="Permisos de usuario"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection