<?php

namespace App\Http\Controllers\Auth;



use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**：
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'isAdmin' => ['required','boolean'],
            'profile' => ['image']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (isset($data['profile'])){
            $file = $data['profile'];
            $new_id = 1;
            if (User::all()->isNotEmpty()){
                $statement = DB::select("show table status like 'users'");
                $max_id =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
                $max_id = json_decode($max_id)->max_id;
                $new_id+=$max_id;
            }
            $filename = 'user'.$new_id.'.jpg';
            $path = 'public/user/';

            $file->storeAs($path,$filename);
        }



        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'isAdmin' => $data['isAdmin'],
            'password' => Hash::make($data['password']),
            'profile' => (isset($filename)?('storage/user/'.$filename):null),

        ]);
    }
}
