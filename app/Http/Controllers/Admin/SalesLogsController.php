<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Response;
use Illuminate\Http\Request;

class SalesLogsController extends Controller
{
    public function index()
    {
        //$sales = User::where('role', 'admin')->orderBy('id', 'desc')->paginate(7);
        return view('admin.sales');  
    }

    
}
