<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements JWTSubject,MustVerifyEmail
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile','isAdmin','bonus'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'member_id','id');
    }

    public function im_sender()
    {
        return $this->hasMany(Message::class,'sender_id','id');
    }

    public function im_receiver()
    {
        return $this->hasMany(Message::class,'receiver_id','id');
    }

//    public function sendEmailVerificationNotification()
//    {
//        $this->notify(new App\Notifications\CustomVerifyEmail);
//    }
}
