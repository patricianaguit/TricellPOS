<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
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
}
