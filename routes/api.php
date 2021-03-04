<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/depart/{id}','apiController@departmentJSON');
Route::get('/subdepart','apiController@subdepartmentJSON');
Route::get('/products/{id}','apiController@productJSON');
Route::post('/login','apiController@login');

/******************************************** API ROUTES *************************************************************/


Route::post('add-customer','apiController@add_customer');
Route::get('getCustomers/{id}','apiController@getCustomers');
Route::get('getInventory','apiController@productJSON');
Route::get('getInventoryById/{id}','apiController@productJSONByID');
Route::get('getInventoryByDepartment/{id}','apiController@productByDepartment');
Route::get('getInventoryBySubdepartment/{id}','apiController@productBySubdepartment');
Route::post('getsearch','apiController@getjsonsearch');

Route::get('getInventoryByRelated/{id}','apiController@productByRelated');

Route::get('getmultiimage/{id}','apiController@getmultiimage');

Route::get('getDepartments/{id}','apiController@getDepartments');
//Route::post('add-sales','apiController@add_sales');
Route::get('getCountry','apiController@getCountry');
Route::get('getCity','apiController@getCity');
Route::get('topcollection/{id}','apiController@topcollection');
Route::get('newproduct/{id}','apiController@newproduct');
Route::post('add-sales','apiController@addSales');
Route::post('add-sales-details','apiController@addSalesDetails');


/******************************************** API ROUTES *************************************************************/

 
