<?php

namespace App\Http\Controllers;
use App\User;
use Hash;

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
        $staffs = User::where('role', 'staff')->paginate(7);
        return view('staff')->with('staffs', $staffs);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $staff = User::find($request->staff_id);
        $staff->username = $request->username;
        $staff->password = Hash::make($request->password);
        $staff->firstname = $request->firstname;
        $staff->lastname = $request->lastname;
        $staff->address = $request->address;
        $staff->contact_number = $request->contact;
        $staff->email = $request->email;
        $staff->save();
        return response()->json($staff);

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
        return response()->json();
    }
}
