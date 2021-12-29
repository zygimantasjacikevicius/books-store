<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OutfitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (array_key_exists('one', $request->all())) {
            return [
                'id' => $this->id,
                'type' => $this->type,
                'color' => $this->color,
                'price' => $this->price,
                'discount' => $this->discount,
                'final_price' => $this->price - ($this->price * $this->discount / 100),
                'brand_id' => $this->getBrand->title,
                'photos' => $this->getPhotos,
                'tags' => $this->getTags

            ];
        }



        return [
            'id' => $this->id,
            'type' => $this->type,
            'color' => $this->color,
            'price' => $this->price,
            'discount' => $this->discount,
            'final_price' => $this->price - ($this->price * $this->discount / 100),
            'brand_id' => $this->getBrand->title,
            'photo' => $this->getMainPhoto->first()->photo ?? null
        ];
    }
}
