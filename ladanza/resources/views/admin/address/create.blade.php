@extends('admin.templateStatic.template')
@section('title','Registro de direccion')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="#">
        <i class="fas fa-users"></i> Usuarios
    </a>
</li>
<li class="breadcrumb-item">
    <a href="#">
        <i class="fas fa-plus"></i> Registrar direccion
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user_show">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Foto de la persona</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                            @if (is_null($p->avatar))
                                <img src="{{url('styles/images/default_avatar.png')}}" class="avatar" >
                            @else
                                <a href="{{url('/uploads/'.$p->file_image.'/'.$p->avatar)}}" data-fancybox="gallery">
                                    <img src="{{url('/uploads/'.$p->file_image.'/'.$p->avatar)}}" class="avatar">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>  Datos de dirección</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                            <form action="{{route('addressStore')}}" method="POST">
                            @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="label_ini">Zona:</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                                <input type="text" name="zone" value="{{old('zone')}}" class="form-control" placeholder="....." required>
                                                <input type="hidden" name="person_id" value="{{$p->id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label_ini">Barrio:</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                                <input type="text" name="district" value="{{old('district')}}" class="form-control" placeholder="....." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Calle/Avenida 1:</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                                <input type="text" name="street_avenue1" value="{{old('street_avenue1')}}" class="form-control" placeholder="....." required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Calle/Avenida 2:</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                                                <input type="text" name="street_avenue2" value="{{old('street_avenue2')}}" class="form-control" placeholder="....." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Descripción:</label>
                                            <textarea name="description" cols="90" rows="8" class="form-control" placeholder="Numero de casa y descripción (color de casa, porton, etc)..." required>{{old('phone')}}</textarea>
                                        </div>
                                    </div>
                                    <input type="submit" value="Completado" class="btn btn-success mt-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
