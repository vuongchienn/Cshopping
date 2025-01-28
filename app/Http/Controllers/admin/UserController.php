<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy("created_at","desc")->paginate(10);
        return view("admin.user.index",["users"=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
            'name' =>'required|alpha',
            "con-password"=>"required",
            'role'=>'required'
        ]);

        if($validated['password']!=$validated['con-password']){
            return back()->with('error','Confirm password does not match');
        }
        $user = User::create([
            'email'=> $validated['email'],
            'name'=> $validated['name'],
            'password'=> bcrypt($validated['password']),
            'avatar'=>'safsd',
            'role'=> $validated['role'],
        ]);
        return back()->with('success','User created successfully !');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view("admin.user.show",["user"=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);    
        return view("admin.user.edit",["user"=> $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'email'=> 'required|email',
            'name' =>'required|alpha',
            'role' =>'required'
        ]);

        $user->update($validated);
        return redirect()->route('users.show',$user->id)->with('success','This user updated successfully !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','This user deleted successfully !');
    }



    public function search(Request $request){

        $users = User::where('name',$request->search)->orderBy("name","asc")->paginate(10);
        return view("admin.user.index", compact("users"));
    }
}
