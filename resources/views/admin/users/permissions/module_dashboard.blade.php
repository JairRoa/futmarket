<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-pepper-hot"></i> Modulo Dashboard </h2>
        </div>

        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="dashboard" @if(kvfj($u->permissions, 'dashboard')) checked @endif> <label for="dashboard"> Acceso a Dashboard</label>
            </div>
        </div>
    </div>
</div>
