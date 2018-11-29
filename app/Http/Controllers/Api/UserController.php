<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
  function showself (Request $request) {
    return $this->show($request, Auth::user());
  }

  function updateself (Request $request) {
    if (Auth::once([
      'email' => Input::get('old_email'), 
      'password' => Input::get('old_password')
    ])) {
      return $this->update($request, Auth::user());
    } else {
      return ['success' => false, 'error' => 'identify failed'];
    }
  }

  function index(Request $request) {
  }

  function show (Request $request, User $user) {
    UserResource::withoutWrapping();
    return new UserResource($user);
  }

  function update (Request $request, User $user) {
    foreach ($request->all() as $key => $value) {
      if ($user->$key && $key !== "id") {
        if ($key === 'password') $value = bcrypt($value);
        $user->$key = $value;
      }
    }
    $user->save();
    UserResource::withoutWrapping();
    return new UserResource($user);
  }

  function create (Request $request) {
  }

  function destroy (Request $request, $user) {
    if ($user = User::find($user)) {
      if ($user->delete()) {
        return ["success" => true];
      } else {
        return ["success" => false, "error" => "delete failed"];
      }
    } else {
      return ["success" => false, "error" => "user not found"];
    }
  }
}
