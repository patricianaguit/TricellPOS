<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\User;
use App\Product;
use App\Sale;
use App\Sales_details;
use Response;
use App\Discount;
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
        $discounts = Discount::all();
    	return view('admin.pos')->with(['items' => $items, 'allitems' => $allitems, 'vat' => $vat, 'discounts' => $discounts]);
    }

    public function buttonload()
    {
        $items = Product::orderBy('product_name', 'asc')->simplepaginate(32);
        return view('admin.posbuttons')->with('items', $items)->render();
    }

    public function member_autocomplete(Request $request)
    {
        $input = $request->input;
        $member = User::with('balance')->where('role', 'member')->where('card_number', 'LIKE', "{$input}%")->first();
                            
        return json_encode($member);
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
}
