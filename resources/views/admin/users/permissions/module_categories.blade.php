<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-layer-group"></i> Modulo Categorias </h2>
        </div>

        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="categories" @if(kvfj($u->permissions, 'categories')) checked @endif> <label for="categories"> Acceso a Categorías</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="category_add" @if(kvfj($u->permissions, 'category_add')) checked @endif> <label for="category_add"> Agregar categorías</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="category_edit" @if(kvfj($u->permissions, 'category_edit')) checked @endif> <label for="category_edit"> Editar categorías</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="category_delete" @if(kvfj($u->permissions, 'category_delete')) checked @endif> <label for="category_delete"> Eliminar categorías</label>
            </div>
        </div>
    </div>
</div>
