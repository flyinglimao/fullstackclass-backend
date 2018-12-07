<?php

namespace App\Http\Controllers;

use App\Notifications\NotifyOrder;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class MailController extends Controller
{
    public function index(){
        $data = [

        ];
        return view('mymail.index',$data);
    }
    public function index2(){
        Notification::route('mail',Auth::user()->email)
            ->notify(new NotifyOrder(    Order::find(2))      );
        return redirect()->back()->with(['index2'=>'成功寄出index2']);
    }

    public function index3()
    {
        Auth::user()->notify(new NotifyOrder(    Order::find(2)      ));


        return redirect()->back()->with(['index3'=>'成功寄出index3']);
    }

























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
