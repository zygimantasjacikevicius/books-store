<?php

namespace App\Http\Resources;

use App\Models\BookPhoto;
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

        if (array_key_exists('one', $request->all())) {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'isbn' => $this->isbn,
                'pages' => $this->pages,
                'about' => $this->about,
                'author_id' => $this->getAuthor->name . ' ' . $this->getAuthor->surname,
                'photos' => $this->getPhotos,
                'tags' => $this->getTags

            ];
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isbn' => $this->isbn,
            'pages' => $this->pages,
            'about' => $this->about,
            'author_id' => $this->getAuthor->name . ' ' . $this->getAuthor->surname,
            'photo' => $this->getMainPhoto->first()->photo ?? null

        ];
    }
}
