@extends('template.admin.front')
@section('content')
<div class="row justify-content-center align-items-center" >
    <div class="col-md-6 col-auto">
        <img src="{{url('/styles/images/logo.jpg')}}" class="img-fluid">
    </div>
    <div class="col-md-6 col-auto">
        <div class="header">
            <span class="head"><strong>Bienvenido luchador</strong></span>
            <span class="title"><strong>Introduce tu codigo:</strong></span>
        </div>
        @if (Session::has('message'))
        <div class="col-md-6 offset-md-3 alert mt-3 alert-{{ Session::get('typealert')}}" style="display:none;">
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
        <form action="{{route('info_search')}}" method="post">
            @csrf
            <div class="search">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <div class="input-group-text"><i class="far fa-smile"></i></div>
                        <input type="number" name="searchClient" class="form-control" placeholder="....." required>
                    </div>
                    <div class="col-md-6 offset-md-3 submit">
                        <input type="submit" value="Verificar" class="btn btn-light w-100">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
