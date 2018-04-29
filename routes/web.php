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

Route::get('/', 'LoginController@index'); 
Route::post('verify', 'LoginController@verify'); 
Route::get('logout', 'LoginController@logout');

Route::group(['middleware' => ['admin']], function () {
	Route::get('accounts/members', 'MemberAccountsController@index');
	Route::get('accounts/admin', 'AdminAccountsController@index');
	Route::get('accounts/staff', 'StaffAccountsController@index');
});