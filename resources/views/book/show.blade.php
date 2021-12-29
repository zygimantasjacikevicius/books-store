@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h1>More about book</h1></div>
                <div class="card-body">
                    <div class="row justify-content-center show-content">
                        <div class="col-4 show-content__block">
                            <span>title:</span><div>{{$book->title}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span>ISBN:</span><div>{{$book->isbn}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span>pages:</span><div>{{$book->pages}}</div>
                        </div>
                        <div class="col-12 show-content__block">
                            <span>about:</span><div>{{$book->about}}</div>
                        </div>
                        <div class="col-12 show-content__block">
                            <span>Photos: </span>
                            <div class="images">
                            @forelse ($book->getPhotos as $photo)
                               <img src="{{$photo->photo}}" alt=""> 
                            @empty
                                <h3>No Photos</h3>
                            @endforelse
                        </div>
                        </div>
                        <a href="{{route('book_pdf', $book)}}" class="btn btn-info m-2">download pdf</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection