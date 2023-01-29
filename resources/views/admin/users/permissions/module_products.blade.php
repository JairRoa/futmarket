<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-carrot"></i> Modulo Productos </h2>
        </div>

        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="products" @if(kvfj($u->permissions, 'products')) checked @endif> <label for="products"> Acceso a Productos</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="product_add" @if(kvfj($u->permissions, 'product_add')) checked @endif> <label for="product_add"> Agregar productos</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="product_edit" @if(kvfj($u->permissions, 'product_edit')) checked @endif> <label for="product_edit"> Editar productos</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="product_search" @if(kvfj($u->permissions, 'product_search')) checked @endif> <label for="product_search"> Buscar productos</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="product_delete" @if(kvfj($u->permissions, 'product_delete')) checked @endif> <label for="product_delete"> Eliminar productos</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="product_gallery_add" @if(kvfj($u->permissions, 'product_gallery_add')) checked @endif> <label for="product_gallery_add"> Insertar imagenes</label>
            </div>
            <div class="form-check">
                <input type="checkbox" value="true" name="product_gallery_delete" @if(kvfj($u->permissions, 'product_gallery_delete')) checked @endif> <label for="product_gallery_delete"> Eliminar imagenes</label>
            </div>
        </div>
    </div>
</div>
