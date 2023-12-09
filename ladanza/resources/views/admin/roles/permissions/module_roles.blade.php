<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-user-cog"></i> Modulo Roles y Permisos</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="rolesIndex"
                    @if(key_value_from_json($rol->permissions, 'rolesIndex')){
                        @checked(true)
                    }
                    @endif
                    >
                    <label for="rolesIndex">Ver listado de roles.</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="rolesCreate"
                    @if(key_value_from_json($rol->permissions, 'rolesCreate')){
                        @checked(true)
                    }
                    @endif
                    >
                    <label for="rolesCreate">Crear roles.</label>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="permissionsEdit"
                    @if(key_value_from_json($rol->permissions, 'permissionsEdit')){
                        @checked(true)
                    }
                    @endif
                    >
                    <label for="permissionsEdit">Editar permisos</label>
                </div>
            </div>
        </div>
    </div>
</div>
