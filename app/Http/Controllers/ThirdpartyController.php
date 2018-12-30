<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ThirdpartyController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $fb_user = Socialite::driver('facebook')->user();

        if ($user = User::where('fb_id',$fb_user->id)->first()){
            Auth::login($user);
            return redirect()->route('home');
        }else{
            if (User::where('email',$fb_user->email)->first()){
                return redirect()->route('login')->with('duplicate_email',"sorry your fb mail is already used in somebody's account");
            }else{
                $user = User::create([
                    'name' => $fb_user->name,
                    'email' => $fb_user->email,
                    'password' => 'FBLOGIN',
                    'fb_id' => $fb_user->id,
                    'isAdmin' => 1
                ]);
                Auth::login($user);
                return redirect()->route('home');
            }
        }

    }
}
