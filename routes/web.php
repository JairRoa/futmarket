<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Router Auth
Route::get('/login', 'App\Http\Controllers\ConnectController@getLogin') -> name('login');
Route::post('/login', 'App\Http\Controllers\ConnectController@postLogin') -> name('login');
Route::get('/recover', 'App\Http\Controllers\ConnectController@getRecover') -> name('recover');
Route::post('/recover', 'App\Http\Controllers\ConnectController@postRecover') -> name('recover');
Route::get('/reset', 'App\Http\Controllers\ConnectController@getReset') -> name('reset');
Route::post('/reset', 'App\Http\Controllers\ConnectController@postReset') -> name('reset');
Route::get('/register', 'App\Http\Controllers\ConnectController@getRegister') -> name('register');
Route::post('/register', 'App\Http\Controllers\ConnectController@postRegister') -> name('register');
Route::get('/logout', 'App\Http\Controllers\ConnectController@getLogout') -> name('logout');
