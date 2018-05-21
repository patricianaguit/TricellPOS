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
	Route::get('accounts/members', 'Admin\MemberAccountsController@index');
	Route::get('accounts/admin', 'Admin\AdminAccountsController@index');
	Route::get('accounts/staff', 'Admin\StaffAccountsController@index');
	Route::post('accounts/create_admin', 'Admin\AdminAccountsController@create');
	Route::get('accounts/view_admindetails', 'Admin\AdminAccountsController@show');
	Route::post('accounts/add_staff', 'Admin\StaffAccountsController@create');
	Route::get('accounts/edit_staff', 'Admin\StaffAccountsController@show');
	Route::post('accounts/update_staff', 'Admin\StaffAccountsController@edit');
	Route::post('accounts/delete_staff', 'Admin\StaffAccountsController@destroy');
	Route::get('accounts/search_staff', 'Admin\StaffAccountsController@search');
	Route::post('accounts/add_admin', 'Admin\AdminAccountsController@create');
	Route::post('accounts/update_admin', 'Admin\AdminAccountsController@edit');
	Route::get('accounts/search_admin', 'Admin\AdminAccountsController@search');
});