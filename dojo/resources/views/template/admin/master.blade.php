<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - La Casa del Peleador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{url('/styles/css/admin.css?v='.time())}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="{{url('/styles/js/admin.js')}}"></script>

    {{-- SweetAlert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- Zoom para imagen lighBox --}}
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

</head>
<body>
    <div class="wrapper">
        <div class="col1">@include('template.admin.sidebar')</div>
        <div class="col2">
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{route('dashboard_index')}}" class="pl-1">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="name">
                    <label><strong>Bienvenido:</strong> {{Auth::user()->person->name}} {{Auth::user()->person->last_name}} {{Auth::user()->person->mother_last_name}}</label>
                    <a href="{{route('login_destroy', Auth::user()->status)}}}}" data-toggle="tooltip" data-placement="top" title="Salir">
                         <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </nav>
            <div class="page">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb breadcrumb-pd">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard_index')}}">
                                    <i class="fas fa-home"></i> Dashboard
                                </a>
                            </li>
                            @yield('breadcrumb')
                            {{-- @show --}}
                        </ol>
                    </nav>
                </div>
                @section('content')
                @show
            </div>
        </div>
    </div>
</body>
</html>
