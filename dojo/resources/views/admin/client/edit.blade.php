@extends('template.admin.master')
@section('title','Editar')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'client_index'))
    <a href="{{route('client_index')}}">
        <i class="fas fa-users"></i> Clientes
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'client_edit'))
    <a href="{{route('client_edit', $client->id)}}">
        <i class="fas fa-edit"></i> Modificar
    </a>
    @endif
</li>
@endsection

@section('content')
<div class="container-fluid">
    @if (Session::has('message'))
    <div class=" alert mt-4 alert-{{ Session::get('typealert')}}" style="display:none;">
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
    <div class="page_user_show">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i>  Foto del cliente</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                        @if (is_null($client->person->avatar))
                            <img src="{{url('styles/images/default_avatar.png')}}" class="avatar" >
                        @else
                            <a href="{{url('/uploads/'.$client->person->fileImage.'/'.$client->person->avatar)}}" data-fancybox="gallery">
                                <img src="{{url('/uploads/'.$client->person->fileImage.'/'.$client->person->avatar)}}" class="avatar">
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i>  Datos personales</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <form action="{{route('person_client_update', $client->person->id)}}" enctype="multipart/form-data" method="post">
                                @method('put')
                                @csrf
                                <div class="col-md-12">
                                    <label class="label_ini">Nombres:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="name" value="{{$client->person->name}}" class="form-control" required>
                                    </div>
                                    <label>Apellidos:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="last_name" value="{{$client->person->last_name}}" class="form-control" required>
                                    </div>
                                    <label>Cédula de identidad:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="number" name="number_document" value="{{$client->person->number_document}}" class="form-control" required>
                                    </div>
                                    <label>Teléfono:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="number" name="phone" value="{{$client->person->phone}}" class="form-control" required>
                                    </div>
                                    <label for="formFile" class="form-label">Foto:</label>
                                    <input class="form-control" type="file" name="avatar" id="formFile">
                                    <input type="submit" value="Modificar" class="btn btn-success mt-3">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i>  Datos de suscripción</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                        <form action="{{route('client_update', $client->id)}}" method="post">
                        @method('put')
                        @csrf
                            <div class="col-md-12">
                                <label class="label_ini">Tipo cliente:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select class="form-select" name="type_client" required>
                                        @if ($client->type_client == 1)
                                            <option hidden value="{{$client->type_client}}">Niño(a)</option>
                                        @else
                                            <option hidden value="{{$client->type_client}}">Adulto</option>
                                        @endif
                                        <option value="1">Niño</option>
                                        <option value="2">Adulto</option>
                                    </select>
                                </div>
                                <label>Becado:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select class="form-select" name="scholarship" required>
                                        <option selected hidden value="{{$client->scholarship}}">{{$client->scholarship}}</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <label>Disciplina:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select class="form-select" name="discipline" required>
                                        <option selected hidden value="{{$client->discipline}}">{{$client->discipline}}</option>
                                        <option value="MMA">MMA</option>
                                        <option value="Boxeo">Boxeo</option>
                                        <option value="Kick Boxing">Kick Boxing</option>
                                    </select>
                                </div>
                                <label>Fecha de inicio:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" name="start" value="{{$client->start}}" class="form-control" required>
                                </div>
                                <label>Fecha fin:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" name="finish" value="{{$client->finish}}" class="form-control" required>
                                </div>
                                <input type="submit" value="Modificar" class="btn btn-success mt-3">
                            <div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
