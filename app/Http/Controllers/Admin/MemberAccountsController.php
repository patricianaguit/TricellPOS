<?php
    
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class MemberAccountsController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->orderBy('id', 'desc')->paginate(7);
        return view('admin.member')->with('members', $members);  
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
        $member = User::find($request->member_id);

        $rules = array(
        'card_number' => "required|unique:users,card_number,$member->id",
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'contact' => 'required',
        'email' => "required|email|unique:users,email,$member->id",
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $member = User::find($request->member_id);
            $member->card_number = $request->card_number;
            $member->firstname = $request->firstname;
            $member->lastname = $request->lastname;
            $member->address = $request->address;
            $member->contact_number = $request->contact;
            $member->email = $request->email;
            $member->save();
        }
    }

    public function destroy(Request $request)
    {
        $member = User::find($request->member_id)->delete();
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
            $staffs = User::where('username', 'LIKE', '%' . $search . '%')->orWhere('firstname', 'LIKE', '%' . $search . '%')->orwhere('lastname', 'LIKE', '%' . $search . '%')->orWhere(DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%' . $search . '%')->where('role', 'staff')->paginate(7);
            $staffs->appends($request->only('staff_search'));
            $count = $staffs->count();
            return view('admin.staff')->with(['staffs' => $staffs, 'search' => $search, 'count' => $count]);  
        }
    }
}
