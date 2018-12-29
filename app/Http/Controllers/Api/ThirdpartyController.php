<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ThirdpartyController extends Controller
{
  public function facebook (Request $request) {
    $client = new \GuzzleHttp\Client();
    $res = $client->get('https://graph.facebook.com/v3.2/me?access_token=' . $request->input('token') . '&fields=name,email,id');
    $data = json_decode($res->getBody());
    if ($user = User::where('fb_id', $data->id)->first()) {
      $token = Auth::guard('api')->login($user);
      return ['token'=>$token, 'token_type'=>'Bearer', 'expires_in'=>3600];
    } else {
      $user = User::create([
        'name' => $data->name,
        'email' => $data->email,
        'password' => 'FBLOGIN',
        'fb_id' => $data->id,
      ]);
      $token = Auth::guard('api')->login($user);
      return ['token'=>$token, 'token_type'=>'Bearer', 'expires_in'=>3600, 'n' => $data];
    }
  }
}
