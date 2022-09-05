<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'checkout' => $this->checkout,
            'status' => $this->status,
            'returned' => $this->date_returned,
            'issue' => $this->issue,
            'books' => BookResource::collection($this->books)[0]->title,
            'user' => new userResource($this->whenLoaded('user')),
        ];
    }
}
