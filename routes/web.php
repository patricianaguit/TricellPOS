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
	Route::get('accounts/admin', 'AdminAccountsController@index');
	Route::get('accounts/staff', 'StaffAccountsController@index');
	Route::post('accounts/create_admin', 'AdminAccountsController@create');
	Route::get('accounts/view_admindetails', 'AdminAccountsController@show');
	Route::get('accounts/edit_staff', 'StaffAccountsController@show');
	Route::post('accounts/update_staff', 'StaffAccountsController@edit')->name('update_staff');
	Route::post('accounts/delete_staff', 'StaffAccountsController@destroy')->name('delete_staff');;
});