<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - La Danza</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">
    <meta name = "routeName" content="{{ Route::currentRouteName() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/static/css/admin.css?v='.time())}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/b277050258.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="{{ asset('/static/js/admin.js?v='.time()) }}"></script>

</head>
<body>
    
    <div class="wrapper">
        <div class="col1">@include('admin.templateStatic.sidebar')</div>
        <div class="col2">
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="fa-solid fa-house-chimney"></i> Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="name">
                    <label><strong>Bienvenido(a):</strong> {{Auth::user()->person->name}} {{Auth::user()->person->last_name}} </label>
                    <a href="{{route('loginDestroy')}}" data-bs-toggle="tooltip" data-bs-title="Salir">
                         <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </nav>

            <div class="page">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="fa-solid fa-house-chimney"></i> Dashboard
                                </a>
                            </li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>

                @if (Session::has('message'))
                    <div class="container">
                        <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display: none;">
                            {{ Session::get('message') }}
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <script>
                                $('.alert').slideDown();
                                setTimeout(function(){ $('.alert').slideUp(); }, 10000);
                            </script>
                        </div>
                    </div>
                @endif

                @section('content')
                    
                @show
            </div>
        </div>
    </div>
   
</body>
</html>