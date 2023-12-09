@extends('template.admin.master')
@section('title','Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_index'))
    <a href="{{route('user_index')}}">
        <i class="fas fa-user"></i> Usuarios
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
            <h2 class="title"><i class="fas fa-user"></i> Usuarios</h2>
            <ul>
                <li>
                    <a href="{{route('person_user_create')}}" >
                        <i class="fas fa-plus"></i> Agregar Nuevo
                    </a>
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
                <form action="{{route('user_index')}}" method="get">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="searchUser" id="searchUser" class="form-control" placeholder="Ingrese su busqueda">
                        </div>
                        <div class="col-md-4">
                            <select name="type" id="type" class="form-select">
                                <option selected value="">Seleccione el tipo de busqueda</option>
                                <option value="email">Usuario</option>
                                <option value="name">Nombre</option>
                                <option value="last_name">Apellido</option>
                                <option value="number_document">Cédula de identidad</option>
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
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>CEDULA DE IDENTIDAD</th>
                        <th>USUARIO</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <tr>
                            <td>{{$person->name}}</td>
                            <td>{{$person->last_name}}</td>
                            <td>{{$person->number_document}}</td>
                            @if ($person->subscription == 0)
                                <td></td>
                                <td></td>
                            @else
                                <td>{{$person->user->email}}</td>
                                <td>{{$person->user->role->name}}</td>
                            @endif
                            @if ($person->subscription == 0)
                                <td>Pendiente de asignación</td>
                            @else
                                <td>Activo</td>
                            @endif
                            <td>
                                @if ($person->subscription == 0)
                                    <a href="{{route('user_create', $person->id)}}" class="opts"
                                        data-toggle="tooltip" data-placement="top" title="Asignar">
                                        <i class="far fa-calendar-check"></i>
                                    </a>
                                @endif
                                @if (key_value_from_json(Auth::user()->permissions, 'user_show'))
                                    @if ($person->subscription == 2)
                                        <a href="{{route('user_show', $person->user->id)}}" class="opts"
                                            data-toggle="tooltip" data-placement="top" title="Detalle">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                @endif

                                @if (key_value_from_json(Auth::user()->permissions, 'user_edit'))
                                    @if ($person->subscription == 2)
                                        @if ($person->user->status == 1)
                                        <a href="{{route('user_edit', $person->user->id)}}" class="opts"
                                            data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif
                                    @endif
                                @endif

                                @if (key_value_from_json(Auth::user()->permissions, 'user_destroy'))
                                    @if ($person->subscription == 2)
                                        @if ($person->user->status == 1)
                                        <a href="#" data-object="{{$person->user->id}}" data-action="destroy" data-path="dojo/public/admin/user"
                                            class="btn-destroy opts" data-toggle="tooltip" data-placement="top" title="Suspender">
                                            <i class="fas fa-user-slash"></i>
                                        </a>
                                        @else
                                        <a href="#" data-object="{{$person->user->id}}" data-action="restore" data-path="dojo/public/admin/user"
                                            class="btn-destroy opts" data-toggle="tooltip" data-placement="top" title="Activar">
                                            <i class="fas fa-user-check"></i>
                                        </a>
                                        @endif
                                    @endif
                                @endif

                                @if (key_value_from_json(Auth::user()->permissions, 'user_permissions'))
                                    @if ($person->subscription == 2)
                                        @if ($person->user->status == 1)
                                        <a href="{{route('user_permissions', $person->id)}}" class="opts"
                                            data-toggle="tooltip" data-placement="top" title="Permisos">
                                            <i class="fas fa-cog"></i>
                                        </a>
                                        @endif
                                    @endif
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $people->render() !!}
        </div>
    </div>
</div>
@endsection
