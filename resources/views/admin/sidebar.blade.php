<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('static/images/berenjena.png') }}" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle">HOLA: </span>
            <div class="name">
                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
            </div>
            <div class="email">{{ Auth::user()->email }}
                <a href="{{ url ('/logout') }}" data-toggle="tooltip" data-placement="top" title="Cerrar Sesión">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions, 'dashboard'))
            <li>
                <a href="{{ url ('/admin')}}" class="lk-dashboard"><i class="fa-solid fa-pepper-hot"></i> Dashboard</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'products'))
            <li>
                <a href="{{ url ('/admin/products/all')}}" class="lk-products lk-product_add lk-product_search lk-product_edit lk-product_gallery_add"><i class="fa-solid fa-carrot"></i> Productos</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'categories'))
            <li>
                <a href="{{ url ('/admin/categories/0')}}" class="lk-categories lk-category_add lk-category_edit lk-category_delete"><i class="fa-solid fa-layer-group"></i> Categorías</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_list'))
            <li>
                <a href="{{ url ('/admin/users/all')}}" class="lk-user_list lk-user_edit lk-user_permissions"><i class="fa-solid fa-people-group"></i> Usuarios</a>
            </li>
            @endif
        </ul>
    </div>
</div>
