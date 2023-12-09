@extends('template.admin.master')
@section('title','Registro')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'role_index'))
    <a href="{{route('role_index')}}">
        <i class="fas fa-user-cog"></i> Roles
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'role_create'))
    <a href="{{route('role_create')}}">
        <i class="fas fa-plus"></i> Registrar rol
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
            <h2 class="title"><i class="fas fa-plus"></i> Registrar rol</h2>
        </div>
        <div class="inside">
            <form action="{{route('role_store')}}" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Nombre del rol:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="text" name="name" class="form-control" placeholder="....." required>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label>Descripción:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
                            <input type="text" name="description" class="form-control" placeholder="....." required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3 mtp-10">
                        <input type="submit" class="btn btn-success w-100" value="Completado">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
