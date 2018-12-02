<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:6',
        'password_confirmation' => 'required|string|same:password',
        'profile' => 'string'
      ]
    );

    if ($validator->fails()) {
      return ['success' => false];
    } else {

      User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
      ]);

      return response()->json([
        'success' => true,
      ]);
    }
  }

  public function login(Request $request)
  {
    $this->validate($request,[
      'email'=> 'required|string',
      'password' => 'required|string|min:6',
    ]);
    $credentials = request(['email', 'password']);

    if (! $token = auth('api')->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }
  public function logout()
  {
    auth('guard')->logout();
    return response()->json(['message' => 'successfully logged out']);
  }

  public function refresh()
  {
    return $this->respondWithToken(auth('api')->refresh());
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'token' => $token,
      'token_type' => 'Bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60
    ]);
  }
}
