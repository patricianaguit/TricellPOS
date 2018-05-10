<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = User::where('role', 'admin')->paginate(7);
        return view('admin')->with('admins', $admins);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //     //
    //     $rules = array(
    //         'username' => 'required',
    //         'password' => 'required',
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'email' => 'required'
    //     );

    //     $validator = Validator::make (input::all(), $rules);

    //     if($validator->fails())
    //         return response::json(array('errors' => $validator->getMessageBag()->toarray()));
    //     else
    //         $admin = new user;
    //         $admin->username = $req->username;
    //         $admin->password = $req->password;
    //         $admin->firstname = $req->firstname;
    //         $admin->lastname = $req->lastname;
    //         $admin->email = $req->lastname;

    //         $admin->save();
    //         return response()->json($admin);
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
        if($request->ajax()){
            $id = $request->id;
            $info = User::find($id);
            //echo json_decode($info);
            return response()->json($info);
        }

    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
