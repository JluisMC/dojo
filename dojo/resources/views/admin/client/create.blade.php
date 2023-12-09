@extends('template.admin.master')
@section('title','Registro')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'client_index'))
    <a href="{{route('client_index')}}">
        <i class="fas fa-users"></i> Clientes
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'client_create'))
    <a href="{{route('client_create', $person->id)}}">
        <i class="fas fa-plus"></i> Registrar cliente
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
                        <h2 class="title"><i class="fas fa-plus"></i>  Foto del cliente</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                        @if (is_null($person->avatar))
                            <img src="{{url('styles/images/default_avatar.png')}}" class="avatar" >
                        @else
                            <a href="{{url('/uploads/'.$person->fileImage.'/'.$person->avatar)}}" data-fancybox="gallery">
                                <img src="{{url('/uploads/'.$person->fileImage.'/'.$person->avatar)}}" class="avatar">
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Datos personales</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label_ini">Nombres:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" class="form-control"value="{{$person->name}}" readonly>
                                </div>
                                <label>Apellidos:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="text" class="form-control"value="{{$person->last_name}}" readonly>
                                </div>
                                <label>Cédula de identidad:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" class="form-control"value="{{$person->number_document}}" readonly>
                                </div>
                                <label>Teléfono:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="number" class="form-control"value="{{$person->phone}}" readonly>
                                </div>
                                <label for="formFile" class="form-label">Foto:</label>
                                <input class="form-control" type="file" name="avatar" id="formFile" disabled>
                                <input type="submit" value="Completado" class="btn btn-success mt-3 disabled">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Datos de suscripción</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                        <form action="{{route('client_store')}}" method="post">
                        @csrf
                            <div class="col-md-12">
                                <label class="label_ini">Tipo cliente:</label>
                                <input type="hidden" name="person_id" value="{{$person->id}}">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select class="form-select" name="type_client" required>
                                        <option selected hidden value="">Seleccione una tipo</option>
                                        <option value="1">Niño</option>
                                        <option value="2">Adulto</option>
                                    </select>
                                </div>
                                <label>Becado:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select class="form-select" name="scholarship" required>
                                        <option selected hidden value="">Seleccione una tipo</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <label>Disciplina:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select class="form-select" name="discipline" required>
                                        <option selected hidden value="">Seleccione una disciplina</option>
                                        <option value="MMA">MMA</option>
                                        <option value="Boxeo">Boxeo</option>
                                        <option value="Kick Boxing">Kick Boxing</option>
                                    </select>
                                </div>
                                <label>Fecha de inicio:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" name="start" class="form-control" required>
                                </div>
                                <label>Fecha fin:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" name="finish" class="form-control" required>
                                </div>
                                <input type="submit" value="Completado" class="btn btn-success mt-3">
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
