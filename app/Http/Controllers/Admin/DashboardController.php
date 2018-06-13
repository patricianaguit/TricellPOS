<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Reload_sale;
use App\Sale;
use App\Product;
use Carbon\Carbon;
use Response;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()	
    {	
        $newmembers = User::where('role', 'member')->where('created_at', '>', Carbon::now()->subDays(7))->count();
        $reloadsales = Reload_sale::where('transaction_date', '>', Carbon::now()->subDays(30))->count();
        $sales = Sale::where('transaction_date', '>', Carbon::now()->subDays(30))->count();
        $stock_ind = DB::table('profile')->select('low_stock')->where('id', 1)->first();
        $lowstock = Product::where('product_qty', '<=', $stock_ind->low_stock)->count();
        return view('admin.dashboard')->with(['newmembers' => $newmembers, 'lowstock' => $lowstock, 'reloadsales' => $reloadsales, 'sales' => $sales]);
    }

}
