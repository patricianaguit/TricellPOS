<?php

namespace App\Http\Controllers;
use App\User;
use Hash;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class StaffAccountsController extends Controller
{
    public function index()
    {
        $staffs = User::where('role', 'staff')->orderBy('id', 'desc')->paginate(7);
        return view('staff')->with('staffs', $staffs);  
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
            $staff = new User;
            $staff->username = $request->username;
            $staff->password = Hash::make($request->password);
            $staff->firstname = $request->firstname;
            $staff->lastname = $request->lastname;
            $staff->address = $request->address;
            $staff->contact_number = $request->contact;
            $staff->email = $request->email;
            $staff->role = 'staff';
            $staff->save();
        }
        // return Response::json($staff);
    }

    public function edit(Request $request)
    {
        $staff = User::find($request->staff_id);

        $messages = [
            'required.username' => 'The Username field is required.',
            'required.password' => 'The Password field is required.',
            'required.password_confirmation' => 'The Confirm Password field is required.',
            'required.firstname' => 'The First Name field is required.',
            'required.lastname' => 'The Last Name field is required.',
            'required.address' => 'The Address field is required.',
            'required.contact' => 'The Contact Number field is required.',
            'required.email' => 'The Email field is required.',
        ];

        $rules = array(
        'username' => "required|unique:users,username,$staff->id",
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'contact' => 'required',
        'email' => "required|email|unique:users,email,$staff->id",
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
        $staff = User::find($request->staff_id);
        $staff->username = $request->username;
        $staff->password = Hash::make($request->password);
        $staff->firstname = $request->firstname;
        $staff->lastname = $request->lastname;
        $staff->address = $request->address;
        $staff->contact_number = $request->contact;
        $staff->email = $request->email;
        $staff->save();
        // return Response::json($staff);
        }
    }

    public function destroy(Request $request)
    {
        $staff = User::find($request->staff_id)->delete();
    }

    public function search(Request $request)
    {
        $search = $request->staff_search;

        if($search == "")
        {
            return \Redirect::to('accounts/staff');
            // $staffs = User::where('role', 'staff')->orderBy('id', 'desc')->paginate(7);
            // return view('staff')->with('staffs', $staffs);  
        }
        else
        {
            $staffs = User::where('username', 'LIKE', '%' . $search . '%')->where('role', 'staff')->paginate(7);
            $staffs->appends($request->only('staff_search'));
            $count = User::where('username', 'LIKE', '%' . $search . '%')->where('role', 'staff')->count();
            return view('staff')->with(['staffs' => $staffs, 'search' => $search, 'count' => $count]);  
        }
    }
}
