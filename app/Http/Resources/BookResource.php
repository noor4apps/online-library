<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'isbn' => $this->isbn,
            'quantity' => $this->quantity,
            'edition' => $this->edition,
            'volume' => $this->volume,
            'issue' => $this->issue,
            'cover' => $this->cover,
            'is_pdf' => $this->is_pdf,
            'url' => $this->url,
        ];
    }
}
