@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h1>More about the outfit</h1></div>
                <div class="card-body">
                    <div class="row justify-content-center show-content">
                        <div class="col-4 show-content__block">
                            <span>Type:</span><div>{{$outfit->type}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span>Color:</span><div>{{$outfit->color}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span>Price:</span><div>{{$outfit->price}}</div>
                        </div>
                        <div class="col-12 show-content__block">
                            <span>Discount:</span><div>{{$outfit->discount}}</div>
                        </div>
                        <div class="col-12 show-content__block">
                            <span>Photos: </span>
                            <div class="images">
                            @forelse ($outfit->getPhotos as $photo)
                               <img src="{{$photo->photo}}" alt=""> 
                            @empty
                                <h3>No Photos</h3>
                            @endforelse
                        </div>
                        </div>
                        <a href="{{route('outfit_pdf', $outfit)}}" class="btn btn-info m-2">download pdf</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection