<?php

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
    return view('listado');
});


Route::get('user','UserController@index')->name('user.index');
Route::post('user/register','UserController@store')->name('user.store');
Route::put('user/update','UserController@update')->name('user.update');
Route::put('user/active','UserController@activo')->name('user.activo');
Route::put('user/inactive','UserController@inactivo')->name('user.inactivo');
Route::delete('user/delete','UserController@destroy')->name('user.delete');

Route::get('permission','PermissionController@index')->name('permission.index');


Route::get('role','RoleController@index')->name('role.index');
Route::post('role/register','RoleController@store')->name('role.store');
Route::put('role/update','RoleController@update')->name('role.update');
Route::put('role/active','RoleController@activo')->name('role.activo');
Route::put('role/inactive','RoleController@inactivo')->name('role.inactivo');

Route::get('typeroom','TypeRoomController@index')->name('typeroom.index');
Route::post('typeroom/register','TypeRoomController@store')->name('typeroom.store');
Route::put('typeroom/update','TypeRoomController@update')->name('typeroom.update');
Route::put('typeroom/activo','TypeRoomController@activo')->name('typeroom.activo');
Route::put('typeroom/inactivo','TypeRoomController@inactivo')->name('typeroom.inactivo');
Route::get('typeroom/listRoomActive','TypeRoomController@listRoomActive')->name('typeroom.listRoomActive');


Route::get('room','RoomController@index')->name('room.index');
Route::post('room/register','RoomController@store')->name('room.store');
Route::put('room/update','RoomController@update')->name('room.update');
Route::put('room/activo','RoomController@activo')->name('room.activo');
Route::put('room/statebusy','RoomController@statebusy')->name('room.statebusy');
Route::put('room/statefree','RoomController@statefree')->name('room.statefree');
Route::put('room/inactivo','RoomController@inactivo')->name('room.inactivo');
Route::get('room/active','RoomController@listRoomActive')->name('room.listRoomActive');
Route::get('room/move','RoomController@moveRoom')->name('room.move');
Route::put('room/updatefacture','RoomController@updateFacture')->name('room.updatefacture');
Route::get('room/reservation','RoomController@listReservation')->name('room.reservation');




Route::get('link','LinkController@index')->name('link.index');
Route::post('link/register','LinkController@store')->name('link.store');
Route::put('link/update','LinkController@update')->name('link.update');
Route::put('link/activo','LinkController@activo')->name('link.activo');
Route::put('link/inactivo','LinkController@inactivo')->name('link.inactivo');
Route::get('link/active','LinkController@listLinksActive')->name('link.listLinksActive');

Route::get('customers','CustomersController@index')->name('customers.index');
Route::post('customers/register','CustomersController@store')->name('customers.store');
Route::put('customers/update','CustomersController@update')->name('customers.update');
Route::get('customers/searchClient','CustomersController@searchClient')->name('customers.searchClient');
Route::get('searchCustomer','CustomersController@searchCustomer')->name('customers.searchCustomer');

Route::get('worker','WorkerController@index')->name('worker.index');
Route::post('worker/register','WorkerController@store')->name('worker.store');
Route::put('worker/update','WorkerController@update')->name('worker.update');
Route::put('worker/activo','WorkerController@activo')->name('worker.activo');
Route::put('worker/inactivo','WorkerController@inactivo')->name('worker.inactivo');

Route::get('category','CategoryController@index')->name('category.index');
Route::post('category/register','CategoryController@store')->name('category.store');
Route::put('category/update','CategoryController@update')->name('category.update');
Route::put('category/activo','CategoryController@activo')->name('category.activo');
Route::put('category/inactivo','CategoryController@inactivo')->name('category.inactivo');
Route::get('category/active','CategoryController@listCategoryActive')->name('category.listCategoryActive');

Route::get('additional','AdditionalController@index')->name('additional.index');
Route::post('additional/register','AdditionalController@store')->name('additional.store');
Route::put('additional/update','AdditionalController@update')->name('additional.update');
Route::put('additional/activo','AdditionalController@activo')->name('additional.activo');
Route::put('additional/inactivo','AdditionalController@inactivo')->name('additional.inactivo');
Route::get('additional/active','AdditionalController@listAdditionalActive')->name('additional.listAdditionalActive');
Route::get('additional/listAdditional','AdditionalController@listAdditional')->name('additional.listAdditional');


Route::get('servicie','ServicieController@index')->name('servicie.index');
Route::post('servicie/register','ServicieController@store')->name('servicie.store');
Route::put('servicie/update','ServicieController@update')->name('servicie.update');
Route::put('servicie/activo','ServicieController@activo')->name('servicie.activo');
Route::put('servicie/inactivo','ServicieController@inactivo')->name('servicie.inactivo');
Route::get('servicie/active','ServicieController@listServicieActive')->name('servicie.listservicieActive');

Route::get('provider','ProviderController@index')->name('provider.index');
Route::post('provider/register','ProviderController@store')->name('provider.store');
Route::put('provider/update','ProviderController@update')->name('provider.update');
Route::put('provider/activo','ProviderController@activo')->name('provider.activo');
Route::put('provider/inactivo','ProviderController@inactivo')->name('provider.inactivo');
Route::get('provider/active','ProviderController@listProviderActive')->name('provider.listProvidersActive');

Route::get('product','ProductController@index')->name('product.index');
Route::post('product/register','ProductController@store')->name('product.store');
Route::put('product/update','ProductController@update')->name('product.update');
Route::put('product/activo','ProductController@activo')->name('product.activo');
Route::put('product/inactivo','ProductController@inactivo')->name('product.inactivo');
Route::get('product/active','ProductController@listProductActive')->name('product.listproductsActive');
Route::get('product/provider','ProductController@listProductProvider')->name('product.listproductprovider');

Route::get('certificate','CertificateController@index')->name('certificate.index');
Route::post('certificate/register','CertificateController@store')->name('certificate.store');
Route::put('certificate/update','CertificateController@update')->name('certificate.update');
Route::get('certificate/searchcertificate','CertificateController@searchClient')->name('certificate.searchClient');

Route::get('companion','CompanionController@index')->name('companion.index');
Route::post('companion/register','CompanionController@store')->name('companion.store');
Route::put('companion/update','CompanionController@update')->name('companion.update');
Route::get('companion/searchCompanions','CompanionController@searchCompanions')->name('companion.searchCompanions');

Route::get('counter','CounterController@index')->name('counter.index');
Route::put('counter/update','CounterController@update')->name('counter.update');
Route::get('counter/searchCheck','CounterController@searchCheck')->name('counter.searchCheck');
Route::get('counter/searchTicket','CounterController@searchTicket')->name('counter.searchTicket');
Route::get('counter/searchCertificate','CounterController@searchCertificate')->name('counter.searchCertificate');
Route::get('counter/searchReception','CounterController@searchReception')->name('counter.searchReception');
Route::get('counter/searchExt','CounterController@searchExt')->name('counter.searchExt');
Route::get('counter/searchBuy','CounterController@searchBuy')->name('counter.searchBuy');

Route::get('sale','SaleController@index')->name('sale.index');
Route::post('sale/register','SaleController@store')->name('companion.store');
Route::put('sale/update','SaleController@update')->name('sale.update');
Route::get('sale/searchCheck','SaleController@searchCheck')->name('sale.searchCheck');
Route::get('sale/searchTicket','SaleController@searchTicket')->name('sale.searchTicket');
Route::get('sale/searchCertificate','SaleController@searchCertificate')->name('sale.searchCertificate');
Route::get('sale/searchReception','SaleController@searchReception')->name('sale.searchReception');
Route::get('sale/searchExt','SaleController@searchExt')->name('sale.searchExt');
Route::get('sale/listSales','SaleController@listSales')->name('sale.listSales');

Route::get('bill','BillController@index')->name('bill.index');
Route::post('bill/register','BillController@store')->name('companion.store');
Route::put('bill/update','BillController@update')->name('bill.update');
Route::put('bill/active','BillController@activo')->name('bill.update');
Route::get('bill/searchCheck','BillController@searchCheck')->name('bill.searchCheck');
Route::get('bill/searchTicket','BillController@searchTicket')->name('bill.searchTicket');
Route::get('bill/searchCertificate','BillController@searchCertificate')->name('bill.searchCertificate');
Route::get('bill/searchReception','BillController@searchReception')->name('bill.searchReception');
Route::get('bill/searchExt','BillController@searchExt')->name('bill.searchExt'); 
Route::get('bill/listbills','BillController@listBills')->name('bill.listBills');
Route::get('bill/indexBuy','BillController@indexBuy')->name('bill.indexBuy');
Route::get('bill/detailsBillsBuy','BillController@detailsBillsBuy')->name('bill.detailsBillsBuy');

Route::get('checkbook','CheckbookController@index')->name('checkbook.index');
Route::post('checkbook/register','CheckbookController@store')->name('companion.store');
Route::put('checkbook/update','CheckbookController@update')->name('checkbook.update');
Route::get('checkbook/listcheckbooks','CheckbookController@listCheckbooks')->name('checkbook.listcheckbooks');
Route::get('checkbook/searchTicket','CheckbookController@searchTicket')->name('checkbook.searchTicket');
Route::get('checkbook/searchCertificate','CheckbookController@searchCertificate')->name('checkbook.searchCertificate');
Route::get('checkbook/searchReception','CheckbookController@searchReception')->name('checkbook.searchReception');
Route::get('checkbook/searchExt','CheckbookController@searchExt')->name('checkbook.searchExt');
Route::get('checkbook/listcheckbooks','CheckbookController@listcheckbooks')->name('checkbook.listSales');

Route::get('buy','BuyController@index')->name('buy.index');
Route::post('buy/register','BuyController@store')->name('companion.store');
Route::put('buy/update','BuyController@update')->name('buy.update');
Route::get('buy/searchCheck','BuyController@searchCheck')->name('buy.searchCheck');
Route::get('buy/searchTicket','BuyController@searchTicket')->name('buy.searchTicket');
Route::get('buy/searchCertificate','BuyController@searchCertificate')->name('buy.searchCertificate');
Route::get('buy/searchReception','BuyController@searchReception')->name('buy.searchReception');
Route::get('buy/searchExt','BuyController@searchExt')->name('buy.searchExt');
Route::get('buy/listbuys','BuyController@listbuys')->name('buy.listSales');

Route::get('reservation','ReservationController@index')->name('reservation.index');
Route::post('reservation/register','ReservationController@store')->name('reservation.store');
Route::put('reservation/update','ReservationController@update')->name('reservation.update');
Route::delete('reservation/delete','ReservationController@destroy')->name('reservation.delete');

Route::get('day','DayController@index')->name('day.index');
Route::post('day/register','DayController@store')->name('day.store');
Route::put('day/update','DayController@update')->name('day.update');
Route::get('day/listDays','DayController@listDays')->name('day.listDays');
Route::put('day/inactivo','DayController@inactivo')->name('day.inactivo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/home', function () {
//     return view('listado');
// });
// Route::get('/home', 'HomeController@index')->name('home');
