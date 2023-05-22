<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdmainController extends Controller
{
     public function login(AdminAuthRequest $req)
{
    $validatedData = $req->validated();

    $adminName = env('ADMIN_NAME');
    $adminPassword = env('ADMIN_PASSWORD');

    if ($adminName === $validatedData['name'] && $adminPassword === $validatedData['password']) {
       Session::put('admin',true);
        return redirect()->route('dashboard');
    } else {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
 public function logout()
{
    if (Session::get('admin')) {
        Session::remove('admin');
    }
    Auth::logout();
    Session()->flush();
    return redirect("/");
}
public function dashboard(){
  if(!Session::get('admin'))return redirect('/');
  return view('pages.dashboard');
}
}
