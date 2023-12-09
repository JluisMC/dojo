<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-user-large"></i> Modulo Persona</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="personUserCreate"
                    @if(key_value_from_json($rol->permissions, 'personUserCreate')){
                        @checked(true)
                    }
                    @endif
                    >
                    <label for="personUserCreate">Crear persona usuario.</label>
                </div>
            </div>
        </div>
    </div>
</div>
