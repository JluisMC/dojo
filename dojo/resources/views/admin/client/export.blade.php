<table class="table table-hover">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>CEDULA DE IDENTIDAD</th>
            <th>TIPO DE CLIENTE</th>
            <th>DISCIPLINA</th>
            <td>FECHA DE INICIO</td>
            <td>FECHA FIN</td>
            <th>BECADO</th>
            <th>TELEFONO</th>
            <th>DIAS DISPONIBLES</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($people as $person)
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
            <tr @if($date_today >= $date_finish == "Finalizado") @endif>
                <td>{{$person->name}}</td>
                <td>{{$person->last_name}}</td>
                <td>{{$person->number_document}}</td>
                @if($person->subscription == 1)
                    @if ($person->client->type_client == 1)
                        <td>Niño(a)</td>
                    @else
                        <td>Adulto</td>
                    @endif
                    <td>{{$person->client->discipline}}</td>
                    <td>{{$person->client->start}}</td>
                    <td>{{$person->client->finish}}</td>
                    <td>{{$person->client->scholarship}}</td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                @endif

                <td>{{$person->phone}}</td>
                <td>{{$days}}</td>

                @if ($person->status == 0)
                    <td>Inactivo</td>
                @else
                    <td>Activo</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
