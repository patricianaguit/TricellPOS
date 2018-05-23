<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class InventoryController extends Controller
{
    
    public function index()
    {
    	$products = Product::orderBy('product_name', 'asc')->paginate(7);
    	return view('admin.inventory')->with('products', $products);
    }

    public function search(Request $request)
    {
    	$search = $request->product_search;

        if($search == "")
        {
            return Redirect::to('inventory');
        }
        else
        {
            $products = Product::where(function($query) use ($request, $search)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');
                })->paginate(7);

            $products->appends($request->only('product_search'));
            $count = $products->count();
            $totalcount = Product::where(function($query) use ($request, $search)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');
                })->count();
            return view('admin.inventory')->with(['products' => $products, 'search' => $search, 'count' => $count, 'totalcount' => $totalcount]);  	
        }
    }
}
