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

Route::get('/','HomeController@index');

Auth::routes(['register' => false, 'reset' => false] );

Route::get('/home', 'HomeController@index')->name('home');






//ALLOW ACCESS ONLY FOR ADMIN
Route::middleware(['auth','VerifyAdmin'])->group(function(){
    // MANAGEMENT ROUTES

    Route::get('/management',function(){
        return view('management.index');
    });
    //MANAGEMENT RESOURCE
    Route::resource('/management/category','Management\CategoryController');
    Route::resource('/management/table','Management\TableController');
    Route::resource('management/user','Management\UserController');
    Route::resource('/management/menu','Management\MenuController');

    //REPORT ROUTES

Route::get('/report','Report\ReportController@index');
Route::get('/report/show', 'Report\ReportController@show');

});




//ALOW ACCESS ONLY FOR LOGGED IN USERS
Route::middleware(['auth'])->group(function(){

// CASHIER ROUTES

Route::get('/cashier','Cashier\CashierController@index');
Route::get('/cashier/getTables','Cashier\CashierController@getTables');
Route::get('/cashier/getMenuByCategory/{category_id}', 'Cashier\CashierController@getMenuByCategory');
Route::get('/cashier/getSaleDetailByTable/{table_id}','Cashier\CashierController@getSaleDetailByTable');

Route::post('/cashier/orderFood','Cashier\CashierController@orderFood');
Route::post('/cashier/confirmOrderStatus','Cashier\CashierController@confirmOrderStatus'); 

Route::post('/cashier/deleteSaleDetail','Cashier\CashierController@deleteSaleDetail');

Route::post('/cashier/savePayment','Cashier\CashierController@savePayment');
Route::get('/cashier/showReceipt/{saleID}', 'Cashier\CashierController@showReceipt');
});