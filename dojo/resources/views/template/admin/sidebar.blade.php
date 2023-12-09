<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{url('styles/images/logo.jpg')}}" class="img-fluid">
        </div>
    </div>
    <div class="main">
        <ul>
            @if (key_value_from_json(Auth::user()->permissions, 'dashboard_index'))
                <li>
                    <a href="{{route('dashboard_index')}}"><i class="fas fa-home"></i>Dashboard</a>
                </li>
            @endif
            @if (key_value_from_json(Auth::user()->permissions, 'user_index'))
                <li>
                    <a href="{{route('user_index')}}"><i class="fas fa-user-friends"></i>Usuarios</a>
                </li>
            @endif
            @if (key_value_from_json(Auth::user()->permissions, 'client_index'))
                <li>
                    <a href="{{route('client_index')}}"><i class="fas fa-users"></i>Clientes</a>
                </li>
            @endif
            @if (key_value_from_json(Auth::user()->permissions, 'role_index'))
                <li>
                    <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-network-wired"></i> Componentes
                    </a>
                    <div class="collapse" id="collapseExample" style="margin-left: 20px;">
                        <ul>
                            <li style="list-style: none">
                                <a href={{route('role_index')}}><i class="fas fa-user-cog"></i> Roles</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
