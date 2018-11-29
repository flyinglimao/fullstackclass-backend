<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendmail()
    {
        Mail::raw('測試使用laravel的gamil服務，恭喜您成為我們的一員',function($message){
            $message->to('imbigking12@gmail.com','貓咪書店')->subject('註冊成功');
        });
        return '成功寄信';
    }
}
