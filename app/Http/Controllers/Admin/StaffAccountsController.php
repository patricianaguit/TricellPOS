<?php
    
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class StaffAccountsController extends Controller
{
    public function index()
    {
        $staffs = User::where('role', 'staff')->orderBy('id', 'desc')->paginate(7);
        return view('admin.staff')->with('staffs', $staffs);  
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
    }

    public function edit(Request $request)
    {
        $staff = User::find($request->staff_id);

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

        $validator = Validator::make($request->all(), $rules);
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
            return Redirect::to('accounts/staff');
        }
        else
        {
            $staffs = User::where('role', 'staff')->where(function($query) use ($request, $search)
                {
                    $query->where('username', 'LIKE', '%' . $search . '%')->orWhere('firstname', 'LIKE', '%' . $search . '%')->orwhere('lastname', 'LIKE', '%' . $search . '%')->orWhere(DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%' . $search . '%');
                })->paginate(7);

            $staffs->appends($request->only('staff_search'));
            $count = $staffs->count();
            $totalcount = User::where('role', 'staff')->where(function($query) use ($request, $search)
                {
                    $query->where('username', 'LIKE', '%' . $search . '%')->orWhere('firstname', 'LIKE', '%' . $search . '%')->orwhere('lastname', 'LIKE', '%' . $search . '%')->orWhere(DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%' . $search . '%');
                })->count();

            return view('admin.staff')->with(['staffs' => $staffs, 'search' => $search, 'count' => $count, 'totalcount' => $totalcount]);  
        }
    }
}