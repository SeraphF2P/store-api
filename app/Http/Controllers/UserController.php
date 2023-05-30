<?php

namespace App\Http\Controllers;

use App\Http\Requests\Owner\CreateUserRequest;
use App\Http\Requests\Owner\UpdateUserRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
  {
   $users = User::get();
   return view('pages.users.index',compact('users'));
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
        return view('pages.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $req)
    {
      
       $user= User::create($req->validated());
        if($user):
          return redirect('/users')->with('success','user added successfully');
        else:
          return redirect('/users')->with('error','faild to add the user');
        endif;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
     $user = User::find($id);
        return view('pages.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $req, int $id)
    {
      $user= User::find($id);
      if(isset($user)){
        $user->update($req->validated());
        return redirect('/users')->with('success','updated successfully');
      }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        User::find($id)->delete();
        return  back()->with('success','deleted successfully');
    }
}
