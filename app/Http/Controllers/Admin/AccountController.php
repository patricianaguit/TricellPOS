<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Response;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function index() 
    {   
        return view('admin.account');
    }

    public function edit(Request $request)
    { 
        $staff = User::find(Auth::user()->id);

        $rules = array(
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'contact_number' => 'required|digits_between:7,11',
        'email' => 'required|email',
        'username' => "required|unique:users,card_number,$staff->id",
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $admin = User::find(Auth::user()->id);
            $admin->username = $request->username;
            $admin->password = Hash::make($request->password);
            $admin->firstname = $request->firstname;
            $admin->lastname = $request->lastname;
            $admin->address = $request->address;
            $admin->contact_number = $request->contact;
            $admin->email = $request->email;
            $admin->contact_number = $request->contact_number;
            $admin->save();
        }
    }
}
