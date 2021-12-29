<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Resources\OutfitCollection;
use App\Http\Resources\OutfitResource;
use App\Models\Outfit;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/books', function () {
    return BookResource::collection(Book::all());
});

Route::get('/book/show{id}', function ($id) {
    return BookResource::collection(Book::where('id', $id)->get());
});


Route::get('/outfits', function () {
    return OutfitResource::collection(Outfit::all());
});

Route::get('/outfit/show{id}', function () {
    return OutfitResource::collection(Outfit::all());
});
