<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Reload_sale;
use Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ReloadLogsController extends Controller
{
    public function index()
    {
        $reloads = Reload_sale::paginate(7);
        return view('admin.reload')->with(['reloads' => $reloads]); 
    }

    public function showdetails(Request $request)
    {
    	$sales_id = $request->sales_id;
        $discount_id = $request->discount_id;
        $sales = Sale::where('id', $sales_id)->first();
    	$salesdetails = Sales_details::with('product')->where('sales_id', $sales_id)->get();
        $discounts = Discount::where('id', $discount_id)->get();
    	return view('admin.salesmodal')->with('sales', $sales)->with('salesdetails', $salesdetails)->with('discounts', $discounts);  
    }

    public function destroy(Request $request)
    {
        $sales = Sale::find($request->sales_id)->delete();
        $salesdetails = Sales_details::where('sales_id', $request->sales_id)->delete();

    }

    public function search(Request $request)
    {
        $search = $request->search;

        if($search == "")
        {
            return Redirect::to('logs/sales/');
        }
        else
        {
            $sales = Sale::where(function($query) use ($request, $search)
                {
                    $query->where(\DB::raw("(DATE_FORMAT(transaction_date,'%M %d, %Y'))"), '=', $search);
                })->paginate(7);

            $sales->appends($request->only('search'));
           
            $count = $sales->count();
            $totalcount = Sale::where(function($query) use ($request, $search)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%M %d, %Y'))"), '=', $search);
                })->count();

            $sumsales = Sale::where(DB::raw("(DATE_FORMAT(transaction_date,'%M %d, %Y'))"), '=', $search)->sum('amount_due');
            return view('admin.sales')->with(['sales' => $sales, 'search' => $search, 'count' => $count, 'sumsales' => $sumsales, 'totalcount' => $totalcount]);  
        }
    }
}
