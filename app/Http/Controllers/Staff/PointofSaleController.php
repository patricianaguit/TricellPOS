<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;

use App\User;
use App\Guest;
use App\Balance;
use App\Product;
use App\Sale;
use App\Reload_sale;
use App\Sales_details;
use App\Discount;
use Response;
use Validator;
use DB;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PointofSaleController extends Controller
{
    
    public function index()
    {
        $allitems = Product::orderBy('product_name', 'asc')->get();
    	$items = Product::orderBy('product_name', 'asc')->simplepaginate(32);
        $vat = DB::table('profile')->select('vat')->where('id', 1)->first();
        $lowstock = DB::table('profile')->select('low_stock')->where('id', 1)->first();
        $discounts = Discount::all();
    	return view('staff.pos')->with(['items' => $items, 'allitems' => $allitems, 'vat' => $vat,'lowstock' => $lowstock, 'discounts' => $discounts]);
    }

    public function buttonload()
    {
        $items = Product::orderBy('product_name', 'asc')->simplepaginate(32);
        $lowstock = DB::table('profile')->select('low_stock')->where('id', 1)->first();
        return view('staff.posbuttons')->with(['items' => $items, 'lowstock' => $lowstock])->render();
    }

    public function member_autocomplete(Request $request)
    {
        $input = $request->input;
        $member = User::with('balance')->where('role', 'member')->where('card_number', 'LIKE', "{$input}%")->first();
                            
        return json_encode($member);
    }

    public function guest_cashpayment(Request $request)
    {
        $guest = new Guest;
        $guest->customer_name = $request->customer_name;
        $guest->save();

        $sale = new Sale;
        $sale->member_id = 0;
        $sale->guest_id = $guest->id;
        $sale->discount_id = $request->discount_id;
        $sale->amount_due = $request->amount_due;
        $sale->amount_paid = $request->amount_paid;
        $sale->change_amount = $request->change_amount;
        $sale->payment_mode = 'cash';
        $sale->vat = $request->vat;
        $sale->save();

        $itemsBought = $request->itemsbought;
        $count = count($itemsBought);
        
        for($i= 0; $i < $count; $i++){
            $y=0;
            $sales_details[] = [
                'sales_id' => $sale->id,
                'product_id' => $itemsBought[$i][$y],
                'quantity' => $itemsBought[$i][++$y],
                'subtotal' => $itemsBought[$i][++$y],
                ];
            }
        Sales_details::insert($sales_details);

        for($i= 0; $i < $count; $i++){
            $y=0;
            $product = Product::find($itemsBought[$i][$y]);
            $product->product_qty =  $product->product_qty - $itemsBought[$i][++$y];
            $product->save();
        }
    }

    public function member_cashpayment(Request $request)
    {
        $sale = new Sale;
        $sale->member_id = $request->member_id;
        $sale->guest_id = 0;
        $sale->discount_id = $request->discount_id;
        $sale->amount_due = $request->amount_due;
        $sale->amount_paid = $request->amount_paid;
        $sale->change_amount = $request->change_amount;
        $sale->payment_mode = 'cash';
        $sale->vat = $request->vat;
        $sale->save();

        $itemsBought = $request->itemsbought;
        $count = count($itemsBought);
        
        for($i= 0; $i < $count; $i++){
            $y=0;
            $sales_details[] = [
                'sales_id' => $sale->id,
                'product_id' => $itemsBought[$i][$y],
                'quantity' => $itemsBought[$i][++$y],
                'subtotal' => $itemsBought[$i][++$y],
                ];
            }
        Sales_details::insert($sales_details);

        for($i= 0; $i < $count; $i++){
            $y=0;
            $product = Product::find($itemsBought[$i][$y]);
            $product->product_qty =  $product->product_qty - $itemsBought[$i][++$y];
            $product->save();
        }
    }

    public function member_loadpayment(Request $request)
    {
        $sale = new Sale;
        $sale->member_id = $request->member_id;
        $sale->guest_id = 0;
        $sale->discount_id = $request->discount_id;
        $sale->amount_due = $request->amount_paid;
        $sale->amount_paid = $request->amount_paid;
        $sale->change_amount = 0;
        $sale->payment_mode = 'card load';
        $sale->vat = $request->vat;
        $sale->save();

        $itemsBought = $request->itemsbought;
        $count = count($itemsBought);

        $balance = Balance::find($request->member_id);
        $balance->load_balance = $request->current_load - $request->amount_paid;
        $balance->save();
        
        for($i= 0; $i < $count; $i++){
            $y=0;
            $sales_details[] = [
                'sales_id' => $sale->id,
                'product_id' => $itemsBought[$i][$y],
                'quantity' => $itemsBought[$i][++$y],
                'subtotal' => $itemsBought[$i][++$y],
                ];
            }
        Sales_details::insert($sales_details);

        for($i= 0; $i < $count; $i++){
            $y=0;
            $product = Product::find($itemsBought[$i][$y]);
            $product->product_qty =  $product->product_qty - $itemsBought[$i][++$y];
            $product->save();
        }
    }

    public function reload(Request $request)
    {
        $member = User::find($request->member_id);

        $total_load = $request->reload_amount + $request->current_load;
        $member->balance->load_balance = $total_load;
        $member->balance->save();

        $member_reload = new Reload_sale;
        $member_reload->member_id = $request->member_id;
        $member_reload->amount_due = $request->reload_amount;
        $member_reload->amount_paid = $request->payment_amount;
        $member_reload->change_amount = $request->change_amount;
        $member_reload->save();

        return $total_load;
    }
}
