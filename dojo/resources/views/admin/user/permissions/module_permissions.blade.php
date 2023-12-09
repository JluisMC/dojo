<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-cog"></i> Modulo de Permisos</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="user_permissions"
                @if(key_value_from_json($person->user->permissions,'user_permissions')) checked
                @endif>
                <label for="user_permissions">Puede asignar Permisos</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="role_index"
                @if(key_value_from_json($person->user->permissions,'role_index')) checked
                @endif>
                <label for="role_index">Ver listado de roles</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="role_create"
                @if(key_value_from_json($person->user->permissions,'role_create')) checked
                @endif>
                <label for="role_create">Crear nuevo rol</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="role_edit"
                @if(key_value_from_json($person->user->permissions,'role_edit')) checked
                @endif>
                <label for="role_edit">Editar rol</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="role_destroy"
                @if(key_value_from_json($person->user->permissions,'role_destroy')) checked
                @endif>
                <label for="role_destroy">Desactivar rol</label>
            </div>
        </div>
    </div>
</div>
