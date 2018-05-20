<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AdminAccountsController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->orderBy('id', 'desc')->paginate(7);
        return view('admin')->with('admins', $admins);  
    }

    public function create(Request $request)
    {
        $rules = array(
        'username' => 'required|unique:users,username',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'contact' => 'required|digits_between:7,11',
        'email' => 'required|email',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $admin = new User;
            $admin->username = $request->username;
            $admin->password = Hash::make($request->password);
            $admin->firstname = $request->firstname;
            $admin->lastname = $request->lastname;
            $admin->address = $request->address;
            $admin->contact_number = $request->contact;
            $admin->email = $request->email;
            $admin->role = 'admin';
            $admin->save();
        }
    }

    public function edit(Request $request)
    {
        $admin = User::find($request->admin_id);

        $rules = array(
        'username' => "required|unique:users,username,$admin->id",
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'contact' => 'required',
        'email' => "required|email|unique:users,email,$admin->id",
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $admin = User::find($request->admin_id);
            $admin->username = $request->username;
            $admin->password = Hash::make($request->password);
            $admin->firstname = $request->firstname;
            $admin->lastname = $request->lastname;
            $admin->address = $request->address;
            $admin->contact_number = $request->contact;
            $admin->email = $request->email;
            $admin->save();
        }
    }

    public function search(Request $request)
    {
        $search = $request->admin_search;

        if($search == "")
        {
            return Redirect::to('accounts/admin');
        }
        else
        {
            $admins = User::where('username', 'LIKE', '%' . $search . '%')->where('role', 'staff')->paginate(7);
            $admins->appends($request->only('admin_search'));
            $count = User::where('username', 'LIKE', '%' . $search . '%')->where('role', 'staff')->count();
            return view('admin')->with(['admins' => $admins, 'search' => $search, 'count' => $count]);  
        }
    }
}
