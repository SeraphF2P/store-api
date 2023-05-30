<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\ValidateRoleRequest;
use App\Models\User;
use Error;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
public function signup(SignUpRequest $req)
{
    
        $validatedData = $req->validated();
 

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'isMale' => $validatedData['isMale'],
        'phone' => $validatedData['phone'] ?? null,
        'address' => $validatedData['address'] ?? null,
    ]);
    if (!$user) {
        return response()->json([
          "success" => false,
            'msg' => 'Failed to create user.',
        ], 422);
    }

    $token = $user->createToken('main');
    if (!$token) {
        return response()->json([
          "success" => false,
            'msg' => 'Failed to generate token.',
        ], 422);
    }
Auth::login($user);
    return response()->json([
      "success" => true,
        'token' => $token->plainTextToken,
        'msg' => "signed up successfully",
        'role' => 'guest',
    ]);
}

  public function login(LoginRequest $req)
{
  
        $credentials = $req->validated();
 
    if (Auth::guard('web')->attempt($credentials)) :
      /** @var \App\Models\User $user */
        $user = Auth::guard('web')->user();
        $token = $user->createToken('main');

        return response()->json([
            'success' => true,
            'role' => $user->role,
            'msg' => 'Login successfully',
            'token' => $token->plainTextToken,
        ]);
      else:
        return response()->json([
        'msg' => 'Invalid email or password.',
        'success' => false,
    ], 400);
  endif;

    
}

    public function logout()
    {
        Auth::logout();
        Session()->flush();
        return redirect("/");
    }
    public function validateUserRole(ValidateRoleRequest $req)
    {
      $req->validated();

        $token = $req->bearerToken();
      $validetedToken = PersonalAccessToken::findToken($token);
      if(!isset($validetedToken)){
          return response()->json([
          'success'=> false,
          'msg'=> 'access denied',
        ],401);
      };  
  if($validetedToken):
    if($validetedToken->can($req->ability)){
    $abilities = $validetedToken->get();
      return response()->json([
          'success'=> true,
          'msg'=> 'access granted',
          'abilities'=> $abilities
        ]);
    }else{
    return response()->json([
          'success'=> false,
          'msg'=> 'access denied',
        ],401);
    };
  endif;
}
}
