<?php

namespace App\Http\Controllers;
use App\User;
use Hash;
use Response;
use Validator;
use Illuminate\Http\Request;

class StaffAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $staffs = User::where('role', 'staff')->orderBy('id')->paginate(7);
        return view('staff')->with('staffs', $staffs);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
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
        // return Response::json($staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        if($request->ajax()){
            $id = $request->id;
            $info = User::find($id);
            //echo json_decode($info);
            return response()->json($info);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        $rules = array(
        'username' => 'required',
        'password' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'contact' => 'required',
        'email' => 'required',
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
        $request->session()->flash('message', 'Successfully updated the staff.');
        // return Response::json($staff);
        }
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $staff = User::find($request->staff_id)->delete();
        $request->session()->flash('message', 'Successfully deleted the staff.');
    }
}
