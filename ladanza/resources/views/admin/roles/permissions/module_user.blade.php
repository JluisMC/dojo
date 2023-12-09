<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-users"></i> Modulo Usuario</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="userIndex"
                        @if(key_value_from_json($rol->permissions, 'userIndex')){
                            @checked(true)
                        }
                        @endif
                    >
                    <label for="userIndex">Ver listado de usuarios.</label>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="userCreate"
                        @if(key_value_from_json($rol->permissions, 'userCreate')){
                            @checked(true)
                        }
                        @endif
                    >
                    <label for="userCreate">Crear nuevos usuarios.</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="userEdit"
                        @if(key_value_from_json($rol->permissions, 'userEdit')){
                            @checked(true)
                        }
                        @endif
                    >
                    <label for="userEdit">Modificar usuarios.</label>
                </div>

            </div>
        </div>
    </div>
</div>
