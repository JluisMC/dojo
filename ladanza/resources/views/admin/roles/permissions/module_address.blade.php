<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-location-dot"></i> Modulo Dirección</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="addressCreate"
                    @if(key_value_from_json($rol->permissions, 'addressCreate')){
                        @checked(true)
                    }
                    @endif
                    >
                    <label for="addressCreate">Crear direccion domicilio.</label>
                </div>
            </div>
        </div>
    </div>
</div>
