<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Brand extends Model
{
    use HasFactory;

    public function getOutfits()
    {
        return $this->hasMany(Outfit::class, 'brand_id', 'id');
    }

    public function handlePortret(Request $request, $mode = 'create')
    {
        if ($request->delete_photo) {
            $this->deleteOldPortret();
            $this->photo = null;
            return;
        }

        if ($request->file('brand_photo')) {
            $photo = $request->file('brand_photo'); // informacija apie faila
            $photoName = rand(10000000, 99999999);
            $photExt = $photo->getClientOriginalExtension(); // failo ispletimas
            $photoName = $photoName . '.' . $photExt;
            $destinationPath = public_path() . '/img/brands'; // serverio kelias (be http)
            $photo->move($destinationPath, $photoName);
            if ('edit' == $mode && $this->photo) {
                $this->deleteOldPortret();
            }
            $this->photo = asset('img/brands/' . $photoName); // irasoma i DB
        }
    }

    public function deleteOldPortret()
    {
        $oldPhoto = $this->photo;
        if (null === $oldPhoto) {
            return;
        }
        $oldPhoto = str_replace(asset(''), '', $oldPhoto);
        $oldPhoto = public_path() . '/' . $oldPhoto;
        if (file_exists($oldPhoto)) {
            unlink($oldPhoto);
        }
    }
}
