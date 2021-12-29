<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    use HasFactory;

    public function getBrand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function getPhotos()
    {
        return $this->hasMany(OutfitPhoto::class, 'outfit_id', 'id');
    }
    public function getMainPhoto()
    {
        return $this->hasMany(OutfitPhoto::class, 'outfit_id', 'id')->limit(1);
    }
    public function getTagOutfits()
    {
        return $this->hasMany(TagOutfit::class, 'outfit_id', 'id');
    }
    public function getTags()
    {
        return $this->belongsToMany(Tag::class, 'tag_outfits', 'outfit_id', 'tag_id');
    }
}
