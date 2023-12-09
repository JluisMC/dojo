@extends('template.admin.master')
@section('title','Detalle')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'client_index'))
    <a href="{{route('client_index')}}">
        <i class="fas fa-users"></i> Clientes
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'client_show'))
    <a href="{{route('client_show', $client->id)}}">
        <i class="fas fa-info-circle"></i> Detalle del cliente
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
                        <h2 class="title"><i class="fas fa-info-circle"></i>  Foto del cliente</h2>
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
                        <h2 class="title"><i class="fas fa-info-circle"></i>  Datos personales</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label_ini">Nombres:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" value="{{$client->person->name}}" class="form-control" readonly>
                                </div>
                                <label>Apellidos:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" value="{{$client->person->last_name}}" class="form-control" readonly>
                                </div>
                                <label>Cédula de identidad:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" value="{{$client->person->number_document}}" class="form-control" readonly>
                                </div>
                                <label>Teléfono:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" value="{{$client->person->phone}}" class="form-control" readonly>
                                </div>
                                <label for="formFile" class="form-label">Foto:</label>
                                <input class="form-control" type="file" name="avatar" id="formFile" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i>  Datos de suscripción</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label_ini">Tipo cliente:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    @if ($client->type_client == 1)
                                        <input type="text" value="Niño(a)" class="form-control" readonly>
                                    @else
                                        <input type="text" value="Adulto" class="form-control" readonly>
                                    @endif
                                </div>
                                <label>Becado:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" value="{{$client->scholarship}}" class="form-control" readonly>
                                </div>
                                <label>Disciplina:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" value="{{$client->discipline}}" class="form-control" readonly>
                                </div>
                                <label>Fecha de inicio:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" value="{{$client->start}}" class="form-control" readonly>
                                </div>
                                <label>Fecha fin:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" value="{{$client->finish}}" class="form-control" readonly>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
