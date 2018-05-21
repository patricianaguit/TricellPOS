<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;    
class LoginController extends Controller
{   

	public function __construct()
	{
		$this->middleware('guest',['except' => 'logout']);
	}

    public function index()
    {
        return view('login');
    }    

    public function verify(Request $request)
    {
        $credentials = $request->only('username', 'password');    
         if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/accounts/members');
        }
        else
        {
        	$request->session()->flash('message', 'The username and password you entered did not match our records. Please double-check and try again.');
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
