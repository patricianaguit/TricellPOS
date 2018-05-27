<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use App\Balance;
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
        'card_number' => 'required|unique:users,card_number',
        'load_balance' => 'required',
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
            $member = new User;
            $member->card_number = $request->card_number;
            $member->firstname = $request->firstname;
            $member->lastname = $request->lastname;
            $member->address = $request->address;
            $member->contact_number = $request->contact;
            $member->email = $request->email;
            $member->role = 'member';
            $member->save();

            $member_load = new Balance(['load_balance' => $request->load_balance]);
            $member->balance()->save($member_load);
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

    public function reload(Request $request)
    {
        $member = User::find($request->member_id);

        $rules = array(
        'load' => 'required|numeric',
        'points' => 'required|numeric',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $member = User::find($request->member_id);
            $member->balance->load_balance = $request->load;
            $member->balance->points = $request->points;
            $member->balance->save();
        }
    }

    public function destroy(Request $request)
    {
        $member = User::find($request->member_id)->delete();
    }

    public function search(Request $request)
    {
        $search = $request->search;

        if($search == "")
        {
            return Redirect::to('accounts/members');
        }
        else
        {
            $members = User::where('role', 'member')->where(function($query) use ($request, $search)
                {
                    $query->where('card_number', 'LIKE', '%' . $search . '%')->orWhere('firstname', 'LIKE', '%' . $search . '%')->orwhere('lastname', 'LIKE', '%' . $search . '%')->orWhere(DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%' . $search . '%');
                })->paginate(7);

            $members->appends($request->only('search'));
            $count = $members->count();
            $totalcount = User::where('role', 'member')->where(function($query) use ($request, $search)
                {
                    $query->where('card_number', 'LIKE', '%' . $search . '%')->orWhere('firstname', 'LIKE', '%' . $search . '%')->orwhere('lastname', 'LIKE', '%' . $search . '%')->orWhere(DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%' . $search . '%');
                })->count();
            return view('admin.member')->with(['members' => $members, 'search' => $search, 'count' => $count, 'totalcount' => $totalcount]);
        }
    }
}
