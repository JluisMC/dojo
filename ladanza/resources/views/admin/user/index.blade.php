@extends('admin.templateStatic.template')

@section('title', 'Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('userIndex') }}">
        <i class="fa-solid fa-users"></i> Usuarios
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fa-solid fa-users"></i> Usuarios
            </h2>
            <ul>
                @if(key_value_from_json(Auth::user()->role->first()->permissions, 'userCreate'))
                <li>
                    <a href="{{route('personUserCreate')}}" >
                        <i class="fas fa-plus"></i> Agregar Nuevo
                    </a>
                </li>
                @endif

                <li>
                    <a href="#" id="btn_search">
                        <i class="fas fa-filter"></i> Filtrar / <i class="fas fa-search"></i> Buscar
                    </a>
                </li>
            </ul>
        </div>

        <div class="inside">
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
            <table class="table mtop16">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->person->name }} {{ $user->person->last_name }}</td>
                        <td>{{ $user->email }}</td>

                        @foreach($user->role as $r)
                            <td>{{ $r->name}}</td>
                        @endforeach

                        <td>{{ status($user->status) }}</td>

                        @if(key_value_from_json(Auth::user()->role->first()->permissions, 'userEdit'))
                            <td>
                                <a href="{{ route('userEdit',$user->id) }}" class="opts" data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        @else
                            <td></td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection