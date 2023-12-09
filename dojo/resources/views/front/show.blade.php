@extends('template.admin.front')
@section('content')

@php
if($person->subscription == 1)
{
    $date_finish = new DateTime($person->client->finish);
    $date_start = new DateTime($person->client->start);
    $date_today = new DateTime('today');

    if ($date_start > $date_today) {
        $days = "Inicia el: ".$date_start->format('Y-m-d');
    }
    else{
        $interval = $date_finish->diff($date_today);
        $days = $interval->format('%R%a');
        $days = $days * (-1)." ". 'dias disponibles.';

        if($days == 0){
            $days = "Hoy, ultimo dia.";
        }
        else{
            if($date_today > $date_finish){
            $days = "Finalizado";
            }
        }
    }
}
else {
    $days = "Sin disciplina asignada";
}
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="out">
            <a href="{{route('info_index')}}" class="float-end opts">
                <i class="fas fa-check-double"></i> Visto
            </a>
        </div>
    </div>
</div>
<br>
<div class="row justify-content-center align-items-center mt-4" >
    <div class="col-md-6 col-auto">
        @if (is_null($person->avatar))
            <img src="{{url('styles/images/default_avatar.png')}}" class="img-fluid avatar" >
        @else
            <a href="{{url('/uploads/'.$person->fileImage.'/'.$person->avatar)}}" data-fancybox="gallery">
                <img src="{{url('/uploads/'.$person->fileImage.'/'.$person->avatar)}}" class="img-fluid avatar">
            </a>
        @endif
    </div>
    <div class="col-md-6 col-auto">
        <div class="info">
            <div class="header">
                <span class="head"><strong>Bienvenido luchador</strong></span>
            </div>
            <span class="name"> Nombre:</span>
            <span class="name">{{$person->name}} {{$person->last_name}}</span><br>
            <span class="name"> Dias restantes:</span><br>
            <span class="text-day">{{$days}}</span>
        </div>
    </div>
</div>

@endsection
