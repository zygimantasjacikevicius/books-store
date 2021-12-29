@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>More about brand</h1>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center show-content">
                        <div class="col-4 show-content__block">
                            <span>Brand name:</span>
                            <div>{{$brand->title}}</div>
                        </div>
                       
                        <div class="col-12 show-content__block">
                            <h4>Outfits by brand</h4>
                            <ul class="list-group">
                                @foreach ($brand->getOutfits as $outfit)
                                
                                <li class="list-group-item">{{$outfit->type}} {{$outfit->color}} {{$outfit->price}} {{$outfit->discount}}
                                    <div class="show-content__buttons">
                                        <a href="{{route('outfit_edit', $outfit)}}" class="btn btn-success m-2">EDIT</a>
                                        <button type="submit" class="delete--button btn btn-danger m-2" data-action="{{route('outfit_delete', [$outfit, 'return' => 'back'])}}">DELETE</button>
                                        <a href="{{route('outfit_show', $outfit)}}" class="btn btn-info m-2">MORE</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirm-modal" style="display:none;">
    <div class="card">
        <h5 class="card-header">Confirmation</h5>
        <div class="card-body">
            <h5 class="card-title">Confirm book delete</h5>
            <div class="buttons">
            <form action="" class="m-1" method="post">
                <button type="submit" class="btn btn-danger">DELETE</button>
                @method('DELETE')
                @csrf
            </form>
            <button type="button" class="cancel--confirm--button btn btn-info m-1">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
    