<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
        'sender' => $this->sender,
        'type' => $this->type,
        'message' => $this->message,
        'time' => $this->created_at->toDateString(),
      ];
    }
}
