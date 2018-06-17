<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Guest;
use App\Product;
use App\Discount;
use App\Sale;
use App\Sales_details;
use Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class SalesLogsController extends Controller
{
    public function index()
    {
        $sales = Sale::orderBy('transaction_date', 'desc')->paginate(7);
        $sumsales = Sale::sum('amount_due');
        return view('admin.sales')->with(['sales'=> $sales, 'sumsales' => $sumsales]);
    }

    public function showdetails(Request $request, $id)
    {   
        $sales = Sale::find($id);
        if(!isset($sales))
        {
            return view('errors.404');
        } 
        else
        {
            $profile = DB::table('profile')->select('*')->where('id', 1)->first();
            $salesdetails = Sales_details::with('product')->where('sales_id', $sales->id)->get();
            $subtotal = Sales_details::selectRaw('SUM(subtotal)')->where('sales_id', $sales->id)->pluck('SUM(subtotal)');
            $cashier = User::find($sales->staff_name);
            
            if(isset($sales->discount->discount_name))
            {
                $discounts = Discount::where('id', $sales->discount_id)->first();
            }
            else
            {
                $discounts = '';
            }
            return view('admin.salesmodal')->with(['sales' => $sales, 'salesdetails' => $salesdetails, 'cashier' => $cashier, 'profile' => $profile,'discounts' => $discounts, 'subtotal' => $subtotal]); 
        } 
    }

    public function destroy(Request $request)
    {
        if($request->type == 'guest')
        {
            $guest = Guest::find($request->cust_id)->delete();
        }
        $sales = Sale::find($request->sales_id)->delete();
        $salesdetails = Sales_details::where('sales_id', $request->sales_id)->delete();
    }

    public function filter(Request $request)
    {
        $account_type = $request->account_type;  
        $payment_mode = $request->payment_mode;
        $daterange = array_map('trim', explode('-', $request->date_filter));

        $date_start = date('Y-m-d',strtotime($daterange[0]));
        $date_end = date('Y-m-d',strtotime($daterange[1]));

        if($account_type == 'Any' && $payment_mode != 'Any')
        {
            $sales = Sale::where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end);
                })->where('payment_mode', $payment_mode)->orderBy('transaction_date', 'desc')->paginate(7);

            $sales->appends($request->only('account_type', 'payment_mode', 'date_filter'));
           
            $count = $sales->count();
            $totalcount = Sale::where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end);
                })->where('payment_mode', $payment_mode)->count();

            $sumsales = Sale::where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->Where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end)->where('payment_mode', $payment_mode)->sum('amount_due');
            return view('admin.sales')->with(['sales' => $sales,'count' => $count, 'account_type' => $account_type, 'payment_mode' => $payment_mode, 'date_start' => $date_start, 'date_end' => $date_end, 'sumsales' => $sumsales, 'totalcount' => $totalcount]);  
        }
        else if($account_type != 'Any' && $payment_mode == 'Any')
        {
            $sales = Sale::with('user')->where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
            {
                $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%m %d,      %Y'))"), '<=', $date_end);
            })->whereHas('User', function($query) use ($account_type)
                {
                        $query->where('role', $account_type);
                })->orderBy('transaction_date', 'desc')->paginate(7);

            $sales->appends($request->only('account_type', 'payment_mode', 'date_filter'));
           
            $count = $sales->count();
            $totalcount = Sale::with('user')->where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end);
                })->whereHas('User', function($query) use ($account_type)
                {
                        $query->where('role', $account_type);
                })->count();

            $sumsales = Sale::with('user')->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->Where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end)->whereHas('User', function($query) use ($account_type)
                {
                        $query->where('role', $account_type);
                })->sum('amount_due');
            return view('admin.sales')->with(['sales' => $sales,'count' => $count, 'account_type' => $account_type, 'payment_mode' => $payment_mode, 'date_start' => $date_start, 'date_end' => $date_end, 'sumsales' => $sumsales, 'totalcount' => $totalcount]);  
        }
        else if($account_type != 'Any' && $payment_mode != 'Any')
        {
            $sales = Sale::with('user')->where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end);
                })->whereHas('User', function($query) use ($account_type)
                {
                        $query->where('role', $account_type);
                })->where('payment_mode', $payment_mode)->orderBy('transaction_date', 'desc')->paginate(7);

             $sales->appends($request->only('account_type', 'payment_mode', 'date_filter'));
           
            $count = $sales->count();
            $totalcount = Sale::where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end);
                })->whereHas('User', function($query) use ($account_type)
                {
                        $query->where('role', $account_type);
                })->where('payment_mode', $payment_mode)->count();

            $sumsales = Sale::where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->Where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end)->whereHas('User', function($query) use ($account_type)
                {
                        $query->where('role', $account_type);
                })->where('payment_mode', $payment_mode)->sum('amount_due');
            return view('admin.sales')->with(['sales' => $sales,'count' => $count, 'account_type' => $account_type, 'payment_mode' => $payment_mode, 'date_start' => $date_start, 'date_end' => $date_end, 'sumsales' => $sumsales, 'totalcount' => $totalcount]); 
        }
        else 
        {
            $sales = Sale::with('user')->where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end);
                })->orderBy('transaction_date', 'desc')->paginate(7);

             $sales->appends($request->only('account_type', 'payment_mode', 'date_filter'));
           
            $count = $sales->count();
            $totalcount = Sale::where(function($query) use ($request, $account_type, $payment_mode, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end);
                })->count();

            $sumsales = Sale::where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '>=', $date_start)->Where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '<=', $date_end)->sum('amount_due');
            return view('admin.sales')->with(['sales' => $sales,'count' => $count, 'account_type' => $account_type, 'payment_mode' => $payment_mode, 'date_start' => $date_start, 'date_end' => $date_end, 'sumsales' => $sumsales, 'totalcount' => $totalcount]); 
        }
    }
}
