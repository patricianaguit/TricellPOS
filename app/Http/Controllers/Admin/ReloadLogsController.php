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
        $reloads = Reload_sale::orderBy('transaction_date', 'desc')->paginate(7);
        $sumsales = Reload_sale::sum('amount_due');
        return view('admin.reload')->with(['reloads' => $reloads, 'sumsales' => $sumsales]); 
    }

    public function showdetails(Request $request)
    {
        $reload_id = $request->reload_id;
        $reloads = Reload_sale::where('id', $reload_id)->first();
    	return view('admin.reloadmodal')->with('reloads', $reloads);
    }

    public function destroy(Request $request)
    {
        $reloads = Reload_sale::find($request->reload_id)->delete();
    }

    public function filter(Request $request)
    {
        $daterange = array_map('trim', explode('-', $request->date_filter));
        //dd(count($daterange));
        
        if(count($daterange) <= 1)
        {
            return Redirect::to('logs/reload');
        }
        else
        {
            $date_start = date('m/d/Y',strtotime($daterange[0]));
            $date_end = date('m/d/Y',strtotime($daterange[1]));
            $reloads = Reload_sale::where(function($query) use ($request, $date_start, $date_end)
                {
                    $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%m/%d/%Y'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%m/%d/%Y'))"), '<=', $date_end);
                })->orderBy('transaction_date', 'desc')->paginate(7);
            $reloads->appends($request->only('date_filter'));
               
            $count = $reloads->count();
            $totalcount = Reload_sale::where(function($query) use ($request, $date_start, $date_end)
                    {
                        $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%m/%d/%Y'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%m/%d/%Y'))"), '<=', $date_end);
                    })->count();

            $sumsales = Reload_sale::where(function($query) use ($request, $date_start, $date_end)
                    {
                        $query->where(DB::raw("(DATE_FORMAT(transaction_date,'%m/%d/%Y'))"), '>=', $date_start)->where(DB::raw("(DATE_FORMAT(transaction_date,'%m/%d/%Y'))"), '<=', $date_end);
                    })->sum('amount_due');
            return view('admin.reload')->with(['reloads' => $reloads,'count' => $count, 'date_start' => $date_start, 'date_end' => $date_end, 'sumsales' => $sumsales, 'totalcount' => $totalcount]);  
        }
        
    }

    
}
