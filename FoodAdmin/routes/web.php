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
    return view('welcome');
});

//Login
Route::get('login', 'controllerAdmin@getLogin');
Route::post('login-app', 'controllerAdmin@getLoginApp');

//Food
Route::post('food-list', 'controllerFood@getFoodList');
Route::post('food-add', 'controllerFood@getFoodAdd');
Route::post('food-add-control', 'controllerFood@postFoodAddControl');
Route::post('food-edit-{IDFood}', 'controllerFood@getFoodEdit');
Route::post('food-control-edit-{IDFood}', 'controllerFood@postFoodControlEdit');
Route::post('food-delete-{IDFood}', 'controllerFood@getFoodDelete');
Route::get('food-search-ajax', 'controllerFood@getFoodSearchAjax');

//Category
Route::post('category-list', 'controllerCategory@getCategoryList');
Route::post('category-add', 'controllerCategory@getCategoryAdd');
Route::post('category-add-control', 'controllerCategory@postCategoryAddControl');
Route::post('category-edit-{ID}', 'controllerCategory@getCategoryEdit');
Route::post('category-control-edit-{ID}', 'controllerCategory@postCategoryControlEdit');
Route::post('category-delete-{ID}', 'controllerCategory@getCategoryDelete');
Route::get('category-search-ajax', 'controllerCategory@getCategorySearchAjax');

//Table
Route::post('table-list', 'controllerTable@getTableList');
Route::post('table-add', 'controllerTable@getTableAdd');
Route::post('table-add-control', 'controllerTable@postTableAddControl');
Route::post('table-edit-{ID}', 'controllerTable@getTableEdit');
Route::post('table-control-edit-{ID}', 'controllerTable@postTableControlEdit');
Route::post('table-delete-{ID}', 'controllerTable@getTableDelete');
Route::get('table-search-ajax', 'controllerTable@getTableSearchAjax');

//Account
Route::post('account-list', 'controllerAccount@getAccountList');
Route::post('account-add', 'controllerAccount@getAccountAdd');
Route::post('account-add-control', 'controllerAccount@getAccountAddControl');
Route::post('account-edit-{Username}', 'controllerAccount@getAccountEdit');
Route::post('account-control-edit-{Username}', 'controllerAccount@postAccountControlEdit');
Route::post('account-delete-{Username}', 'controllerAccount@getAccountDelete');
Route::get('account-search-ajax', 'controllerAccount@getAccountSearchAjax');

//Dashboard
Route::post('bill-list', 'controllerBill@getBillList');
Route::post('bill-delete-{ID}', 'controllerBill@getBillDelete');
Route::post('bill-search', 'controllerBill@getBillSearch');
Route::post('dashboard', 'controllerAdmin@getDashboard');
Route::post('dashboard-year', 'controllerAdmin@getDashboardYear');


Route::get('test', function(){
    return view('test');
});