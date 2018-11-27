<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $time_interval = json_decode($this->time_interval);
      $time_interval->start = $time_interval->start->date;
      $time_interval->end = $time_interval->end->date;
      return [
        'id' => $this->id,
        'url' => $this->url,
        'title' => $this->title,
        'description' => $this->description,
        'hero_image' => $this->hero_image,
        'side_image' => $this->side_image,
        'time_interval' => $time_interval,
      ];
    }
}
