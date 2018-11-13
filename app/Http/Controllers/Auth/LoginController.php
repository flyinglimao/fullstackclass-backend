<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//我加的
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/products';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //我加的
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('login');
    }

    //我亂搞的，這個function override RedirectsUsers.php的function
//    public function redirectPath()
//    {
//        if (Auth::user()->sign_up_complete()==0){
//            return redirect()->intended();
//        }
//        else{
//            return route('login');
//        }
//    }


    //這個function可以客製化 登入所需的東西，譬如說要名字
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
    }
    //這個function理論上可以決定要用什麼東西登入 在AuthenticatedUsers.php有prototype


    protected function authenticate(Request $request)
    {
        if (Auth::attempt([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>$request->input('password')
            ]))
        {
            // Authentication passed...
            return redirect()->intended('/products');
        }
        return redirect()->route('login');
    }



}
