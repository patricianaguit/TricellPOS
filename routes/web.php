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
	//Dashboard
	Route::get('dashboard', 'Admin\DashboardController@index');

   	//POS
   	Route::get('sales', 'Admin\PointofSaleController@index');
   	Route::get('sales/buttons', 'Admin\PointofSaleController@buttonload');
   	Route::post('sales/member_cashpayment', 'Admin\PointofSaleController@member_cashpayment');
   	Route::post('sales/member_loadpayment', 'Admin\PointofSaleController@member_loadpayment');
   	Route::get('sales/member_autocomplete', 'Admin\PointofSaleController@member_autocomplete');
   	Route::post('sales/guest_cashpayment', 'Admin\PointofSaleController@guest_cashpayment');
   	Route::post('sales/member_reload', 'Admin\PointofSaleController@reload');

	//Sales Logs
	Route::get('logs/sales', 'Admin\SalesLogsController@index');
	Route::get('logs/sales/showdetails/{id}', 'Admin\SalesLogsController@showdetails');
	Route::post('logs/sales/delete_sales', 'Admin\SalesLogsController@destroy');
	Route::get('logs/sales/filter', 'Admin\SalesLogsController@filter');

	//Reload Logs
	Route::get('logs/reload', 'Admin\ReloadLogsController@index');
	Route::get('logs/reload/showdetails/{id}', 'Admin\ReloadLogsController@showdetails');
	Route::get('logs/reload/filter', 'Admin\ReloadLogsController@filter');
	Route::post('logs/reload/delete_reload', 'Admin\ReloadLogsController@destroy');

	//Inventory
	Route::get('inventory', 'Admin\InventoryController@index');
	Route::get('inventory/search', 'Admin\InventoryController@search');
	Route::get('inventory/search_healthy', 'Admin\InventoryController@search_healthy');
	Route::get('inventory/search_low', 'Admin\InventoryController@search_low');
	Route::post('inventory/update_product', 'Admin\InventoryController@edit');
	Route::post('inventory/delete_product', 'Admin\InventoryController@destroy');
	Route::post('inventory/add_product', 'Admin\InventoryController@create');
	Route::get('inventory/low_stocks', 'Admin\InventoryController@lowstocks');
	Route::get('inventory/healthy_stocks', 'Admin\InventoryController@healthystocks');
	
	//Accounts - Member
	Route::get('accounts/members', 'Admin\MemberAccountsController@index');
	Route::post('accounts/update_member', 'Admin\MemberAccountsController@edit');
	Route::post('accounts/delete_member', 'Admin\MemberAccountsController@destroy');
	Route::post('accounts/add_member', 'Admin\MemberAccountsController@create');
	Route::post('accounts/reload_member', 'Admin\MemberAccountsController@reload');
	Route::get('accounts/search_member', 'Admin\MemberAccountsController@search');

	//Accounts - Admin
	Route::get('accounts/admin', 'Admin\AdminAccountsController@index');
	Route::get('accounts/view_admindetails', 'Admin\AdminAccountsController@show');
	Route::post('accounts/add_admin', 'Admin\AdminAccountsController@create');
	Route::post('accounts/update_admin', 'Admin\AdminAccountsController@edit');
	Route::get('accounts/search_admin', 'Admin\AdminAccountsController@search');

	//Accounts - Staff
	Route::get('accounts/staff', 'Admin\StaffAccountsController@index');
	Route::post('accounts/add_staff', 'Admin\StaffAccountsController@create');
	Route::get('accounts/edit_staff', 'Admin\StaffAccountsController@show');
	Route::post('accounts/update_staff', 'Admin\StaffAccountsController@edit');
	Route::post('accounts/delete_staff', 'Admin\StaffAccountsController@destroy');
	Route::get('accounts/search_staff', 'Admin\StaffAccountsController@search');

	//Preferences
	Route::get('preferences/backup', 'Admin\BackupController@index');
	Route::get('backup/create', 'Admin\BackupController@create');
    Route::get('backup/download/{file_name}', 'Admin\BackupController@download');
   	Route::get('backup/delete/{file_name}', 'Admin\BackupController@delete');
   	Route::get('preferences/backup/search', 'Admin\BackupController@search');
   	Route::get('preferences/profile', 'Admin\ProfileController@index');
   	Route::post('preferences/update_profile', 'Admin\ProfileController@edit');
   	Route::get('preferences/discounts', 'Admin\DiscountsController@index');
   	Route::post('preferences/add_discount', 'Admin\DiscountsController@create');
   	Route::post('preferences/update_discount', 'Admin\DiscountsController@edit');
   	Route::post('preferences/delete_discount', 'Admin\DiscountsController@destroy');
   	Route::get('preferences/discounts/search', 'Admin\DiscountsController@search');

   	//Account
   	Route::get('/account', 'Admin\AccountController@index');
   	Route::post('/update_account', 'Admin\AccountController@edit');

   
});

Route::group(['middleware' => ['staff']], function () {
	//POS
	Route::get('staff/sales', 'Staff\PointofSaleController@index');
   	Route::get('staff/sales/buttons', 'Staff\PointofSaleController@buttonload');
   	Route::post('staff/sales/member_cashpayment', 'Staff\PointofSaleController@member_cashpayment');
   	Route::post('staff/sales/member_loadpayment', 'Staff\PointofSaleController@member_loadpayment');
   	Route::get('staff/sales/member_autocomplete', 'Staff\PointofSaleController@member_autocomplete');
   	Route::post('staff/sales/guest_cashpayment', 'Staff\PointofSaleController@guest_cashpayment');
   	Route::post('staff/sales/member_reload', 'Staff\PointofSaleController@reload');

   	//Sales Logs
   	Route::get('staff/logs/sales', 'Staff\SalesLogsController@index');
	Route::get('staff/logs/sales/showdetails/{id}', 'Staff\SalesLogsController@showdetails');
	Route::post('staff/logs/sales/delete_sales', 'Staff\SalesLogsController@destroy');
	Route::get('staff/logs/sales/filter', 'Staff\SalesLogsController@filter');

	//Reload Logs
	Route::get('staff/logs/reload', 'Staff\ReloadLogsController@index');
	Route::get('staff/logs/reload/showdetails/{id}', 'Staff\ReloadLogsController@showdetails');
	Route::get('staff/logs/reload/filter', 'Staff\ReloadLogsController@filter');
	Route::post('staff/logs/reload/delete_reload', 'Staff\ReloadLogsController@destroy');

	//Preferences
	Route::get('staff/preferences/backup', 'Staff\BackupController@index');
	Route::get('staff/backup/create', 'Staff\BackupController@create');
    Route::get('staff/backup/download/{file_name}', 'Staff\BackupController@download');
   	Route::get('staff/backup/delete/{file_name}', 'Staff\BackupController@delete');
   	Route::get('staff/preferences/backup/search', 'Staff\BackupController@search');
   	Route::get('staff/preferences/profile', 'Staff\ProfileController@index');
   	Route::post('staff/preferences/update_profile', 'Staff\ProfileController@edit');
   	Route::get('staff/preferences/discounts', 'Staff\DiscountsController@index');
   	Route::post('staff/preferences/add_discount', 'Staff\DiscountsController@create');
   	Route::post('staff/preferences/update_discount', 'Staff\DiscountsController@edit');
   	Route::post('staff/preferences/delete_discount', 'Staff\DiscountsController@destroy');
   	Route::get('staff/preferences/discounts/search', 'Staff\DiscountsController@search');

   	//Account
   	Route::get('staff/account', 'Staff\AccountController@index');
   	Route::post('staff/update_account', 'Staff\AccountController@edit');

});