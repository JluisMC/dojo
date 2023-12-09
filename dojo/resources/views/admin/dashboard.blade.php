@extends('template.admin.master')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    {{-- @if (key_value_from_json(Auth::user()->permissions, 'dashboard_small_stats')) --}}
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-chart-bar"></i>
                Estadísticas rápidas.
            </h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-users"></i>
                        Clientes Registrados.
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">
                        {{$registrados}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user-check"></i>
                        Clientes Activos.
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">
                        {{$activos}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user-ninja"></i>
                        Clientes en Boxeo.
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">
                        {{$boxeo}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user-ninja"></i>
                        Clientes en Kick boxing.
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">
                        {{$kick_boxing}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
</div>
@endsection
