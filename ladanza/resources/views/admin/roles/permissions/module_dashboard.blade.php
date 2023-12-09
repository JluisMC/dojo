<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-home"></i> Modulo Dashboard</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <div class="checkbox-group">
                    <input type="checkbox" value="true" name="dashboard"
                    @if(key_value_from_json($rol->permissions, 'dashboard')){
                        @checked(true)
                    }
                    @endif
                    >
                    <label>Ver dashboard.</label>
                </div>
            </div>
        </div>
    </div>
</div>
