<?php

use Illuminate\Support\Facades\Route;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;

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

//EXPORTAR A EXCEL
Route::get('/reportes/generar_excel/{lotes}', 'ReportesController@generar_excel')->name('reportes.generar_excel');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::resource('admin', AdminController::class);
Route::resource('proveedores', ProveedoresController::class);
Route::resource('clientes', ClientesController::class);



Route::get('/ajax-autocomplete-search', 'PesoBrutoController@selectSearch')->name('selectSearch');
Route::get('/pesobruto/peso_bascula','PesoBrutoController@pesobascula')->name('pesobascula');

//Route::post('/reportes/ajaxshowdetallepesobruto','ReportesController@index');


Route::get('/pesobruto/lotes_anulados', 'PesoBrutoController@lotes_anulados')->name('pesobruto.lotes_anulados');
Route::post('/pesobruto/anular_lote', 'PesoBrutoController@anular_lote')->name('pesobruto.anular_lote');
Route::get('/pesobruto/registros_anulados', 'PesoBrutoController@registros_anulados')->name('pesobruto.registros_anulados');
Route::post('/pesobruto/anular_registro', 'PesoBrutoController@anular_registro')->name('pesobruto.anular_registro');
Route::post('/pesobruto/registrar_gavetas', 'PesoBrutoController@registrar_gavetas')->name('pesobruto.registrar_gavetas');
Route::post('/pesobruto/liquidar_lote', 'PesoBrutoController@liquidar_lote')->name('pesobruto.liquidar_lote');
Route::get('/reportes/generar_pdf/{id}', 'ReportesController@generar_pdf')->name('reportes.generar_pdf');
//rutas para generar pdf y detalla lotes
Route::get('/reportes/generar_pdf_general/{lotes}', 'ReportesController@generar_pdf_general')->name('reportes.generar_pdf_general');
Route::post('/reportes/detalle_lotes', 'ReportesController@detalle_lotes')->name('reportes.detalle_lotes');
//Route::post('/reportes/show_detalle', 'ReportesController@show_detalle')->name('reportes.show_detalle');



Route::resource('pesobruto', PesoBrutoController::class);
Route::resource('pesoneto', PesoNetoController::class);
Route::resource('entregas', EntregasController::class);
Route::resource('reportes', ReportesController::class);

