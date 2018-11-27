<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
  public function index (Request $request) {
    return response()->json(EventResource::collection(Event::all()));
  }

}
