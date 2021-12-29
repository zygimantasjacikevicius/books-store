<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPhoto extends Model
{
    use HasFactory;

    public function handleImage($photo, $mode = 'create')
    {
        // if ($request->delete_photo) {
        //     $this->deleteOldPortret();
        //     $this->photo = null;
        //     return;
        // }


        if ($photo) {
            $photoName = rand(10000000, 99999999);
            $photExt = $photo->getClientOriginalExtension(); // failo ispletimas
            $photoName = $photoName . '.' . $photExt;
            $destinationPath = public_path() . '/img/books'; // serverio kelias (be http)
            $photo->move($destinationPath, $photoName);
            // if ('edit' == $mode && $this->photo) {
            //     $this->deleteOldPortret();
            // }
            $this->photo = asset('img/books/' . $photoName); // irasoma i DB
        }
    }

    public function deleteOldImage()
    {
        $oldPhoto = $this->photo;
        $oldPhoto = str_replace(asset(''), '', $oldPhoto);
        $oldPhoto = public_path() . '/' . $oldPhoto;
        if (file_exists($oldPhoto)) {
            unlink($oldPhoto);
        }
    }
}
