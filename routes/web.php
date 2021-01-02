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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::resource('admin', AdminController::class);
Route::resource('proveedores', ProveedoresController::class);

Route::get('/pesobruto/anulados', 'PesoBrutoController@anulados')->name('pesobruto.anulados');
Route::post('/pesobruto/anular', 'PesoBrutoController@anular')->name('pesobruto.anular');
Route::resource('pesobruto', PesoBrutoController::class);

Route::resource('pesoneto', PesoNetoController::class);
Route::resource('entregas', EntregasController::class);