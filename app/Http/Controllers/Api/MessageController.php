<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Message;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
  public function show(Request $request) {
    MessageResource::withoutWrapping();
    return MessageResource::collection(Message::where('member_id', Auth::id())->get());
  }

  public function destroy(Request $request, Message $message) {
    if ($message->member_id === Auth::id()) {
      if ($message->delete()) {
        return ['success' => true];
      } else {
        return ['success' => false, 'error' => 'delete failed'];
      }
    } else {
        return ['success' => false, 'error' => 'message not found'];
    }
  }
}
