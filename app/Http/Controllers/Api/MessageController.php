<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Message;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
  public function index(Request $request) {
    MessageResource::withoutWrapping();
    return MessageResource::collection(Message::where('receiver_id', Auth::id())->paginate(15));
  }

  public function show(Request $request, Message $message) {
    if ($message->receiver_id === Auth::id()) {
      MessageResource::withoutWrapping();
      return new MessageResource($message);
    } else {
      return ['success' => false, 'error' => 'no permission'];
    }
  }

  public function destroy(Request $request, Message $message) {
    if ($message->receiver_id === Auth::id()) {
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
