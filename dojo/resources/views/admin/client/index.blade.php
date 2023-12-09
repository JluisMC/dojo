@extends('template.admin.master')
@section('title','Luchadores')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'client_index'))
    <a href="{{route('client_index')}}">
        <i class="fas fa-users"></i> Clientes
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
            <h2 class="title"><i class="fas fa-users"></i> Clientes</h2>
            <ul>
                <li>
                    @if (key_value_from_json(Auth::user()->permissions, 'person_client_create'))
                    <a href="{{route('person_client_create')}}" >
                        <i class="fas fa-plus"></i> Agregar Nuevo
                    </a>
                    @endif
                </li>
                <li>
                    @if (key_value_from_json(Auth::user()->permissions, 'client_export'))
                    <a href="{{route('client_export')}}" >
                        <i class="fas fa-file-download"></i> Exportar
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
                <form action="{{route('client_index')}}" method="get">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="searchClient" id="searchClient" class="form-control" placeholder="Ingrese su busqueda">
                        </div>
                        <div class="col-md-4">
                            <select name="type" id="type" class="form-select">
                                <option selected value="">Seleccione el tipo de busqueda</option>
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
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>CEDULA DE IDENTIDAD</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        @php
                        if($person->subscription == 1)
                        {
                            $date_finish = new DateTime($person->client->finish);
                            $date_start = new DateTime($person->client->start);
                            $date_today = new DateTime('today');

                            if ($date_start > $date_today) {
                                $days = "Inicia el: ".$date_start->format('Y-m-d');
                            }
                            else{
                                $interval = $date_finish->diff($date_today);
                                $days = $interval->format('%R%a');
                                $days = $days * (-1)." ". 'dias disponibles.';

                                if($days == 0){
                                    $days = "Hoy, ultimo dia.";
                                }
                                else{
                                    if($date_today > $date_finish){
                                    $days = "Finalizado";
                                    }
                                }
                            }
                        }
                        else {
                            if ($person->subscription == 0) {
                                $days = "Sin disciplina asignada";
                            }
                        }
                        @endphp
                        <tr
                        @if ($person->subscription == 1)
                            @if($days == "Finalizado")
                            class="table-danger";
                            @else
                                @if ($days == "Hoy, ultimo dia." )
                                    class="table-warning";
                                @else
                                    @if ($days == "Inicia el: ".$date_start->format('Y-m-d'))
                                        class="table-success";
                                    @endif
                                @endif
                            @endif
                        @else
                            @if($days == "Sin disciplina asignada")
                                class="table-info";
                            @endif
                        @endif
                        >
                            <td>{{$person->name}}</td>
                            <td>{{$person->last_name}}</td>
                            <td>{{$person->number_document}}</td>
                            <td>{{$days}}</td>
                            <td>
                                @if ($person->subscription == 0)
                                    <a href="{{route('client_create', $person->id)}}" class="opts"
                                        data-toggle="tooltip" data-placement="top" title="Programar">
                                        <i class="far fa-calendar-check"></i>
                                    </a>
                                @endif
                                @if (key_value_from_json(Auth::user()->permissions, 'client_show'))
                                    @if ($person->subscription == 1)
                                    <a href="{{route('client_show', $person->client->id)}}" class="opts"
                                        data-toggle="tooltip" data-placement="top" title="Detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endif
                                @endif

                                @if (key_value_from_json(Auth::user()->permissions, 'client_edit'))
                                    @if ($person->subscription == 1)
                                        @if ($person->client->status == 1)
                                        <a href="{{route('client_edit', $person->client->id)}}" class="opts"
                                            data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif
                                    @endif
                                @endif
                                @if (key_value_from_json(Auth::user()->permissions, 'client_destroy'))
                                    @if ($person->subscription == 1)
                                        @if ($person->client->status == 1)
                                        <a href="#" data-object="{{$person->client->id}}" data-action="destroy" data-path="dojo/public/admin/client"
                                            class="btn-destroy opts" data-toggle="tooltip" data-placement="top" title="Suspender">
                                            <i class="fas fa-user-slash"></i>
                                        </a>
                                        @else
                                        <a href="#" data-object="{{$person->client->id}}" data-action="restore" data-path="dojo/public/admin/client"
                                            class="btn-destroy opts" data-toggle="tooltip" data-placement="top" title="Activar">
                                            <i class="fas fa-user-check"></i>
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
