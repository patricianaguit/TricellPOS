<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use App\Discount;
use App\Sale;
use App\Sales_details;
use Response;
use Illuminate\Http\Request;

class SalesLogsController extends Controller
{
    public function index()
    {
        $sales = Sale::paginate(7);
        // $salesdetails = Sales_details::with('product')->where('sales_id', 1)->get();
        //$salesdetails = Sales_details::all();
        return view('admin.sales')->with('sales', $sales);//->with('salesdetails', $salesdetails); 
    }

    public function showdetails(Request $request)
    {
    	$sales_id = $request->sales_id;
        $discount_id = $request->discount_id;
    	//dd($sales_id);
    	$salesdetails = Sales_details::with('product')->where('sales_id', $sales_id)->get();
        $discounts = Discount::where('id', $discount_id)->get();
    	return view('admin.salesmodal')->with('salesdetails', $salesdetails)->with('discounts', $discounts);  
    }


    
}
