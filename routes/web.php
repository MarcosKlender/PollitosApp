<?php

use Illuminate\Support\Facades\Route;
use App\Exports\PostsExport;
use App\Exports\PostsExportEntrega;
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
Route::get('/reportes/generar_excel_consolidado/{lotes}', 'ReporteLoteGeneralController@generar_excel_consolidado')->name('reportes.generar_excel_consolidado');
Route::get('/reportesentregas/generar_excel_entrega/{entregas}', 'ReporteEntregaController@generar_excel_entrega')->name('reportesentregas.generar_excel_entrega');
//Route::get('/reportesentregas/generar_excel_entrega_general/{entregas}', 'ReporteEntregaController@generar_excel_entrega_general')->name('reportesentregas.generar_excel_entrega_general');

//Route::get('/reportesentregas/generar_excel_entrega_general/{fechaini}/{fechafin}', 'ReporteEntregaController@generar_excel_entrega_general')->name('reportesentregas.generar_excel_entrega_general');

Route::get('/reportesentregas/generar_excel_entrega_general', 'ReporteEntregaController@generar_excel_entrega_general')->name('reportesentregas.generar_excel_entrega_general');

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
Route::resource('basculaconfiguracion', BasculaConfiguracionController::class);
Route::resource('configuracion', ConfiguracionController::class);

Route::get('/ajax-autocomplete-search', 'PesoBrutoController@selectSearch')->name('selectSearch');
Route::get('/ajax-autocomplete-search2', 'BasculasController@selectSearch')->name('selectSearch2');
Route::get('/ajax-autocomplete-search4', 'BasculasController@selectSearchBascula')->name('selectSearchBascula');
Route::get('/ajax-autocomplete-search3', 'EntregasController@selectSearch')->name('selectSearch3');
Route::get('/pesobruto/peso_bascula','PesoBrutoController@pesobascula')->name('pesobascula');

Route::get('/pesobruto/seccion', 'PesoBrutoController@index2')->name('seccion');
Route::get('/pesobruto/seccion_gvacia', 'PesoBrutoController@ws_gaveta_vacia')->name('seccion_gvacia');

//Route::post('/reportes/ajaxshowdetallepesobruto','ReportesController@index');

Route::get('/pesobruto/lotes_anulados', 'PesoBrutoController@lotes_anulados')->name('pesobruto.lotes_anulados');
Route::post('/pesobruto/anular_lote', 'PesoBrutoController@anular_lote')->name('pesobruto.anular_lote');
Route::get('/pesobruto/registros_anulados', 'PesoBrutoController@registros_anulados')->name('pesobruto.registros_anulados');
Route::get('/pesobruto/gavetas_anuladas', 'PesoBrutoController@gavetas_anuladas')->name('pesobruto.gavetas_anuladas');
Route::post('/pesobruto/anular_registro', 'PesoBrutoController@anular_registro')->name('pesobruto.anular_registro');
Route::post('/pesobruto/registrar_gavetas', 'PesoBrutoController@registrar_gavetas')->name('pesobruto.registrar_gavetas');
Route::post('/pesobruto/liquidar_lote', 'PesoBrutoController@liquidar_lote')->name('pesobruto.liquidar_lote');
Route::post('/pesobruto/grabar_ahogados_lote', 'PesoBrutoController@grabar_ahogados_lote')->name('pesobruto.grabar_ahogados_lote');
Route::post('/pesobruto/detalle_ahogados', 'PesoBrutoController@detalle_ahogados')->name('pesobruto.detalle_ahogados');
Route::get('/pesobruto/edit_header/{id}', 'PesoBrutoController@edit_header')->name('pesobruto.edit_header');
Route::post('/pesobruto/update_header', 'PesoBrutoController@update_header')->name('pesobruto.update_header');

Route::get('/reportes/generar_pdf/{id}', 'ReportesController@generar_pdf')->name('reportes.generar_pdf');
Route::get('/reportesentregas/generar_pdf/{id}', 'ReporteEntregaController@generar_pdf')->name('reportesentregas.generar_pdf');

//Route::post('/basculas/')
//rutas para generar pdf y detalla lotes
Route::get('/reportes/generar_pdf_general/{lotes}', 'ReportesController@generar_pdf_general')->name('reportes.generar_pdf_general');
Route::post('/reportes/detalle_lotes', 'ReportesController@detalle_lotes')->name('reportes.detalle_lotes');
Route::post('/reportes/detalle_gvacias', 'ReportesController@detalle_gvacias')->name('reportes.detalle_gvacias');
Route::post('/reportes/detalle_visceras', 'ReportesController@detalle_visceras')->name('reportes.detalle_visceras');
Route::post('/reportes/detalle_egresos', 'ReportesController@detalle_egresos')->name('reportes.detalle_egresos');
Route::post('/reportes/detalle_gvacias_egresos', 'ReportesController@detalle_gvacias_egresos')->name('reportes.detalle_gvacias_egresos');

Route::post('/reportesentregas/detalle_entrega', 'ReporteEntregaController@detalle_entrega')->name('reportesentregas.detalle_entrega');
Route::post('/reportesentregas/detalle_presas', 'ReporteEntregaController@detalle_presas')->name('reportesentregas.detalle_presas');
//Route::post('/reportes/show_detalle', 'ReportesController@show_detalle')->name('reportes.show_detalle');

Route::resource('pesobruto', PesoBrutoController::class);

Route::get('/visceras/registros_anulados', 'ViscerasController@registros_anulados')->name('visceras.registros_anulados');
Route::post('/visceras/anular_registro', 'ViscerasController@anular_registro')->name('visceras.anular_registro');
Route::post('/visceras/registrar_gavetas', 'ViscerasController@registrar_gavetas')->name('visceras.registrar_gavetas');
Route::post('/visceras/liquidar_lote', 'ViscerasController@liquidar_lote')->name('visceras.liquidar_lote');
Route::resource('visceras', ViscerasController::class);

Route::get('/egresos/registros_anulados', 'EgresosController@registros_anulados')->name('egresos.registros_anulados');
Route::get('/egresos/gavetas_anuladas', 'EgresosController@gavetas_anuladas')->name('egresos.gavetas_anuladas');
Route::post('/egresos/anular_registro', 'EgresosController@anular_registro')->name('egresos.anular_registro');
Route::post('/egresos/registrar_gavetas', 'EgresosController@registrar_gavetas')->name('egresos.registrar_gavetas');
//Route::post('/egresos/liquidar_lote', 'EgresosController@liquidar_lote')->name('egresos.liquidar_lote');
Route::get('/egresos/peso_bascula_egreso','EgresosController@pesobascula')->name('pesobasculaegreso');
Route::get('/egresos/seccion', 'EgresosController@index2')->name('seccion_egreso');
Route::get('/egresos/seccion_gvacia', 'EgresosController@ws_gaveta_vacia')->name('seccion_gvacia_egreso');
Route::resource('egresos', EgresosController::class);

Route::post('/egresos/liquidar_lote_egresos', 'EgresosPresasController@liquidar_lote_egresos')->name('egresos.liquidar_lote_egresos');
Route::post('/egresos/desechos_lote_egresos', 'EgresosPresasController@desechos_lote_egresos')->name('egresos.desechos_lote_egresos');
Route::post('/egresos/detalle_desechos', 'EgresosPresasController@detalle_desechos')->name('egresos.detalle_desechos');
//Route::resource('egresos', EgresosPresasController::class);

Route::get('/entregas/presas_anuladas', 'EntregasController@presas_anuladas')->name('entregas.presas_anuladas');
Route::get('/entregas/registros_anulados', 'EntregasController@registros_anulados')->name('entregas.registros_anulados');
Route::get('/entregas/entregas_anuladas', 'EntregasController@entregas_anuladas')->name('entregas.entregas_anuladas');
Route::post('/entregas/anular_entrega', 'EntregasController@anular_entrega')->name('entregas.anular_entrega');
Route::post('/entregas/anular_registro', 'EntregasController@anular_registro')->name('entregas.anular_registro');
Route::post('/entregas/liquidar_lote', 'EntregasController@liquidar_lote')->name('entregas.liquidar_lote');
Route::get('/entregas/seccion_entregas', 'EntregasController@index2')->name('seccion_entregas');
Route::get('/entregas/edit_header/{id}', 'EntregasController@edit_header')->name('entregas.edit_header');
Route::post('/entregas/update_header', 'EntregasController@update_header')->name('entregas.update_header');
Route::resource('entregas', EntregasController::class);

Route::resource('liquidados', LiquidadosController::class);
Route::patch('/liquidados2/{id}', 'LiquidadosController@update2')->name('liquidados.update2');
Route::patch('/liquidados3/{id}', 'LiquidadosController@update3')->name('liquidados.update3');

Route::resource('reportes', ReportesController::class);
Route::resource('reportesentregas', ReporteEntregaController::class);
Route::resource('basculas', BasculasController::class, ['except' => ['show']]);

Route::post('/gavetas_vacias/anular', 'GavetasVaciasController@anular')->name('gavetas_vacias.anular');
Route::resource('gavetas_vacias', GavetasVaciasController::class);

Route::post('/gavetas_vacias_egresos/anular', 'GavetasVaciasEgresosController@anular')->name('gavetas_vacias_egresos.anular');
Route::resource('gavetas_vacias_egresos', GavetasVaciasEgresosController::class);

Route::post('/presas_entregas/anular', 'PresasEntregasController@anular')->name('presas_entregas.anular');
Route::resource('presas_entregas', PresasEntregasController::class);