<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAuthRequest;
use Illuminate\Support\Facades\Auth;

class AdmainController extends Controller
{
     public function login(AdminAuthRequest $req)
{
    if(Auth::guard('owner')->attempt($req->validated())){
      return redirect('/dashboard');
    }
    return abort(403);
}
 public function logout()
{
    Auth::guard('owner')->logout();
    return redirect("/");
}

}
