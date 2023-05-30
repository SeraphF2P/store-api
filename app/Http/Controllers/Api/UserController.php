<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(SignUpRequest $req)
    {
        $validatedData = $req->validated();
        if (isset($user)):
            if (Hash::check($validatedData["password"], $user->password)):
                Auth::login($user);
                return view('pages.dashboard')->with('success', 'Logged in successfully.');
            else:
                return redirect('/')->with('error', 'Invalid email or password.');
            endif;
        else:
            $user = User::create([
                'name' => $validatedData["name"],
                'email' => $validatedData["email"],
                'password' => Hash::make($validatedData["password"]),
            ]);
            Auth::login($user);
            return view('pages.dashboard')->with('success', 'signed up successfully.');
        endif;$user = User::where('email', $validatedData["email"])->first();
        
    }
    public function login(LoginRequest $req)
    {
       $user = User::where('email', $req["email"])->first();
            if ($req["password"] == 'asdasd123' && $req["email"] == 'asd@asd.com'):
              Auth::login($user);
                return view('pages.dashboard')->with('success', 'Logged in successfully.');
            else:
                return redirect('/')->with('error', 'Invalid email or password.');
            endif;
     
    }
    public function logout()
    {
        Auth::logout();
        Session()->flush();
        return redirect("/");
    }

}

