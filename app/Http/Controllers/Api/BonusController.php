<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Bonus;
use App\Http\Resources\BonusResource;

class BonusController extends Controller
{
  public function index(Request $request) {
    return BonusResource::collection(Bonus::where('user_id', Auth::id())->get())->additional(['bonus' => Auth::user()->bonus]);
  }

  public function show(Request $request) {
    return ['bonus' => Auth::user()->bonus];
  }

}
