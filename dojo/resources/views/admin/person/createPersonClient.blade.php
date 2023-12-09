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
    @if (key_value_from_json(Auth::user()->permissions, 'person_client_create'))
    <a href="{{route('person_client_create')}}">
        <i class="fas fa-plus"></i> Registrar cliente
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
    <div class="page_user_show">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Foto del cliente</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                            <img src="{{url('styles/images/default_avatar.png')}}" class="avatar" >
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
                            <form action="{{route('person_client_store')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <label class="label_ini">Nombres:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="name" class="form-control" placeholder="....." required>
                                        <input type="hidden" name="type" value="1">
                                    </div>
                                    <label>Apellidos:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="text" name="last_name" class="form-control" placeholder="....." required>
                                    </div>
                                    <label>Cédula de identidad:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="number" name="number_document" class="form-control" placeholder="....." required>
                                    </div>
                                    <label>Teléfono:</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                        <input type="number" name="phone" class="form-control" placeholder="....." required>
                                    </div>
                                    <label for="formFile" class="form-label">Foto:</label>
                                    <input class="form-control" type="file" name="avatar" id="formFile" required>
                                    <input type="submit" value="Completado" class="btn btn-success mt-3">
                                </div>
                            </form>

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
                            <div class="col-md-12">
                                <label class="label_ini">Tipo cliente:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select disabled class="form-select" name="discipline" required>
                                        <option selected hidden value="">Seleccione un tipo</option>
                                        <option value="Nino">Niño</option>
                                        <option value="Adulto">Adulto</option>
                                    </select>
                                </div>
                                <label>Becado:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select disabled class="form-select" name="discipline" required>
                                        <option selected hidden value="">Seleccione una opción</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <label>Disciplina:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <select disabled class="form-select" name="discipline" required>
                                        <option selected hidden value="">Seleccione una disciplina</option>
                                        <option value="Boxeo">Boxeo</option>
                                        <option value="Kick Boxing">Kick Boxing</option>
                                    </select>
                                </div>
                                <label>Fecha de inicio:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" name="start" class="form-control" readonly>
                                </div>
                                <label>Fecha fin:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                    <input type="date" name="finish" class="form-control" readonly>
                                </div>
                                <input type="submit" value="Completado" class="btn btn-success mt-3 disabled">
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
