<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-user"></i> Modulo Usuario</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="user_index"
                @if(key_value_from_json($person->user->permissions,'user_index')) checked
                @endif>
                <label for="user_index">Ver lista de usuarios</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="user_create"
                @if(key_value_from_json($person->user->permissions,'user_create')) checked
                @endif>
                <label for="user_create">Crear nuevo usuario</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="user_show"
                @if(key_value_from_json($person->user->permissions,'user_show')) checked
                @endif>
                <label for="user_show">Ver detalle del usuario</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="user_edit"
                @if(key_value_from_json($person->user->permissions,'user_edit')) checked
                @endif>
                <label for="user_edit">Editar datos del usuario</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="user_destroy"
                    @if(key_value_from_json($person->user->permissions,'user_destroy')) checked
                    @endif>
                <label for="user_destroy">Suspender usuario</label>
            </div>
        </div>
    </div>
</div>
