<div class="col-md-3 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-home"></i> Modulo Dashboard</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="dashboard_index"
                @if(key_value_from_json($person->user->permissions,'dashboard_index')) checked
                @endif>
                <label for="dashboard_index">Puede ver el dashboard</label>
                <br>
                <input type="checkbox" name="dashboard_small_stats" value="true"
                @if(key_value_from_json($person->user->permissions,'dashboard_small_stats')) checked
                @endif>
                <label for="dashboard_small_stats">Ver estadísticas rápidas.</label><br>
            </div>
        </div>
    </div>
</div>
