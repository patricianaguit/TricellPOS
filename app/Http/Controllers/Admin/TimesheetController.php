<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\Timesheet;
use App\Product;
use Response;
use Validator;
use DB;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class TimesheetController extends Controller
{
    
    public function index()
    {
        $employees = Timesheet::orderBy('id', 'desc')->paginate(7);
        return view('admin.timesheet')->with('employees', $employees); //->with('products', $products);
    }
}   