<?php
use Illuminate\Support\Facades\Route;

    //Module Main
    Route::prefix('/admin')->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@getDashboard')->name('dashboard');

    //Module Users
    Route::get('/users/{status}', 'App\Http\Controllers\Admin\UserController@getUsers')->name('user_list');
    Route::get('/users/{id}/edit', 'App\Http\Controllers\Admin\UserController@getUserEdit')->name('user_edit');
    Route::get('/users/{id}/banned', 'App\Http\Controllers\Admin\UserController@getUserBanned')->name('user_banned');
    Route::get('/users/{id}/permissions', 'App\Http\Controllers\Admin\UserController@getUserPermissions')->name('user_permissions');
    Route::post('/users/{id}/permissions', 'App\Http\Controllers\Admin\UserController@postUserPermissions')->name('user_permissions');

    //Module Products
    Route::get('/products/{status}', 'App\Http\Controllers\Admin\ProductController@getHome')->name('products');
    Route::get('/products/add', 'App\Http\Controllers\Admin\ProductController@getProductAdd')->name('product_add');
    Route::post('/products/add', 'App\Http\Controllers\Admin\ProductController@postProductAdd')->name('product_add');
    Route::get('/products/{id}/edit', 'App\Http\Controllers\Admin\ProductController@getProductEdit')->name('product_edit');
    Route::post('/products/{id}/edit', 'App\Http\Controllers\Admin\ProductController@postProductEdit')->name('product_edit');
    Route::post('/products/search', 'App\Http\Controllers\Admin\ProductController@postProductSearch')->name('product_search');
    Route::post('/products/{id}/gallery/add', 'App\Http\Controllers\Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
    Route::get('/products/{id}/gallery/{gid}/delete', 'App\Http\Controllers\Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');



    //Module Categories
    Route::get('/categories/{module}', 'App\Http\Controllers\Admin\CategoriesController@getHome')->name('categories');
    Route::post('/category/add', 'App\Http\Controllers\Admin\CategoriesController@postCategoryAdd')->name('category_add');
    Route::get('/category/{id}/edit', 'App\Http\Controllers\Admin\CategoriesController@getCategoryEdit')->name('category_edit');
    Route::post('/category/{id}/edit', 'App\Http\Controllers\Admin\CategoriesController@postCategoryEdit')->name('category_edit');
    Route::get('/category/{id}/delete', 'App\Http\Controllers\Admin\CategoriesController@getCategoryDelete')->name('category_delete');

});
