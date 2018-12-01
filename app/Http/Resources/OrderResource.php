<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
        'state' => $this->state,
        'pay_method' => $this->pay_method,
        'payment_information' => json_decode($this->payment_information),
        'message' => $this->message,
        'ship_method' => $this->ship_method,
        'ship_information' => $this->ship_information,
        'ship_order' => $this->ship_order,
        'products' => json_decode($this->products),
        'receiver' => $this->receiver,
        'receiver_phone' => $this->receiver_phone,
        'invoice_number' => $this->invoice_number,
        'coupon' => $this->coupon,
      ];
    }
}
