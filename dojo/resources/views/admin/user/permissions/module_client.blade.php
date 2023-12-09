<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-users"></i> Modulo Cliente</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="client_index"
                    @if(key_value_from_json($person->user->permissions,'client_index')) checked
                    @endif>
                <label for="client_index">Ver listado de clientes</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="client_create"
                    @if(key_value_from_json($person->user->permissions,'client_create')) checked
                    @endif>
                <label for="client_create">Crear nuevo cliente</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="client_show"
                    @if(key_value_from_json($person->user->permissions,'client_show')) checked
                    @endif>
                <label for="client_show">Ver detalle del cliente</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="client_edit"
                    @if(key_value_from_json($person->user->permissions,'client_edit')) checked
                    @endif>
                <label for="client_edit">Editar datos del cliente</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="client_export"
                    @if(key_value_from_json($person->user->permissions,'client_export')) checked
                    @endif>
                <label for="client_export">Puede exportar</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="client_destroy"
                    @if(key_value_from_json($person->user->permissions,'client_destroy')) checked
                    @endif>
                <label for="client_destroy">Desactivar cliente</label>
            </div>
        </div>
    </div>
</div>
