<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{asset('static/images/logo.png')}}" class="img-fluid">
        </div>
    </div>

    <div class="main">
        <ul>
            @if(key_value_from_json(Auth::user()->role->first()->permissions, 'dashboard'))
            <li>
                <a href="{{ route('dashboard') }}" class="lk-dashboard">
                    <i class="fa-solid fa-house-chimney"></i>Dashboard
                </a>
            </li>
            @endif

            @if(key_value_from_json(Auth::user()->role->first()->permissions, 'userIndex'))
                <li>
                    <a href="{{ route('userIndex') }}" class="lk-userIndex lk-personUserCreate lk-addressCreate lk-userCreate">
                        <i class="fa-solid fa-users"></i>Users
                    </a>
                </li>
            @endif

            {{-- @if(key_value_from_json(Auth::user()->role->first()->permissions, 'clientIndex'))
            <li>
                <a href="#" class="lk-client.index lk-personClientCreate">
                    <i class="fa-solid fa-users"></i>Clients
                </a>
            </li>
            @endif

            @if(key_value_from_json(Auth::user()->role->first()->permissions, 'products'))
            <li>
                <a href="#" class="lk-products lk-product.add lk-product.edit">
                    <i class="fa-solid fa-boxes-stacked"></i>Product
                </a>
            </li>
            @endif

            @if(key_value_from_json(Auth::user()->role->first()->permissions, 'categories'))
            <li>
                <a href="#" class="lk-categories lk-category.add lk-category.edit">
                    <i class="fa-solid fa-folder-open"></i>Categorias
                </a>
            </li>
            @endif --}}

            <li>
                <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="lk-rolesIndex">
                    <i class="fas fa-network-wired"></i> Componentes
                </a>
                <div class="collapse" id="collapseExample" style="margin-left: 20px;">
                    <ul>
                        @if(key_value_from_json(Auth::user()->role->first()->permissions, 'rolesIndex'))
                            <li style="list-style: none">
                                <a href="{{route('rolesIndex')}}"><i class="fas fa-user-cog"></i> Roles</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

