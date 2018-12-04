<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendmail()
    {
        $message = "感謝您成為我們的一員，貓咪書店永遠歡銀您，以下是我們的認證網址，點選網址開通認證以獲得更多功能";


        $email = Auth::user()->email;
//        dd([$message,$url,$email]);
        Mail::raw($message,function($message)use($email){
            $message->to($email,'貓咪書店')->subject('註冊成功');
        });

        return redirect()->Auth::route(['verify' => true]);
    }
}
