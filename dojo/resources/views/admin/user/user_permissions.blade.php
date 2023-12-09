@extends('template.admin.master')
@section('title','Permisos')

@section('breadcrumb')
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_index'))
    <a href="{{route('user_index')}}">
        <i class="fas fa-user-friends"></i> Usuarios
    </a>
    @endif
</li>
<li class="breadcrumb-item">
    @if (key_value_from_json(Auth::user()->permissions, 'user_permissions'))
    <a href="{{route('user_permissions', $person->id)}}">
        <i class="fas fa-cog"></i> Permisos de Usuario: {{$person->user->email}}
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
   <div class="page-user">
       <form action="{{route('user_permissions_save', $person->user->id)}}" method="post">
        @method('put')
        @csrf
            <div class="row">
                @include('admin/user/permissions/module_dashboard')
                @include('admin/user/permissions/module_user')
                @include('admin/user/permissions/module_client')
                @include('admin/user/permissions/module_permissions')
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="panel shadow">
                        <div class="inside">
                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <input type="submit" value="Guardar" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </form>
   </div>
</div>
@endsection
