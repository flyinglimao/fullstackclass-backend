<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BonusResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'change' => $this->change,
      'message' => $this->message,
      'order_id' => $this->order_id,
      'time' => $this->created_at->toDateString()
    ];
  }
}
