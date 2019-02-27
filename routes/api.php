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

Route::post('login', 'UserController@login');
Route::put('/users/{user}/settings','UserController@settings');
Route::get('/permissions', 'PermissionController@index');
Route::resource('/offices', 'OfficeController');
Route::resource('/fabrics', 'FabricController');
Route::resource('/designs', 'DesignController');
Route::resource('/colors', 'ColorController');
Route::resource('/products', 'ProductController');
Route::resource('/stocks', 'StockController');
Route::resource('/suppliers', 'SupplierController');
Route::resource('/purchases', 'PurchaseController');
Route::resource('/purchase_articles', 'PurchaseArticleController');
Route::resource('/purchase_payments', 'PurchasePaymentController');
Route::resource('/customers', 'CustomerController');
Route::resource('/sales', 'SaleController');
Route::resource('/sale_articles', 'SaleArticleController');
Route::resource('/sale_payments', 'SalePaymentController');
Route::resource('/user_permissions', 'UserPermissionController');
Route::resource('/users','UserController');