@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-header__wrap">
                        <h1>Outfits list</h1>
                        <div class="card-header__wrap__sort">
                            <form action="{{route('outfit_index')}}" method="GET">
                                <div class="form-group">
                                    
                                    <select name="brand" class="form-control">

                                        <option value="0">Filter By</option>
                                        
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}" @if($brand_id==$brand->id) selected @endif>
                                            {{$brand->title}} 
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info m-1">FILTER</button>
                                <a href="{{route('outfit_index')}}" class="btn btn-warning m-1">RESET</a>
                            </form>
                        </div>
                        <div class="card-header__wrap__sort">
                            <form action="{{route('outfit_index')}}" method="GET">
                                <div class="form-group">
                                    <input type="text" name="s" class="form-control" placeholder="Search" value="{{$s}}">
                                </div>
                                <button type="submit" class="btn btn-info m-1">Search</button>
                                <a href="{{route('outfit_index')}}" class="btn btn-warning m-1">RESET</a>
                            </form>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="container">
                        @forelse ($outfits->chunk(3) as $chunk)
                        <div class="row justify-content-center">
                            @foreach ($chunk as $outfit)
                            <div class="col-12">
                                <div class="index-list">
                                    <div class="index-list__extra">
                                        {{$outfit->type}}
                                    </div>
                                    <div class="index-list__content">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <b>Brand:</b> {{$outfit->getBrand->title}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Type:</b> {{$outfit->type}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Color:</b> {{$outfit->color}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Price:</b> {{$outfit->price}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Discout:</b> {{$outfit->discount}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Photos:</b> {{$outfit->getPhotos->count()}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Taged:</b> {{$outfit->getTagOutfits->count()}}
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="index-list__buttons">
                                        <a href="{{route('outfit_edit', $outfit)}}" class="btn btn-success m-2">REDAGUOTI</a>
                                        <button type="submit" class="delete--button btn btn-danger m-2" data-action="{{route('outfit_delete', $outfit)}}">DELETE</button>
                                        <a href="{{route('outfit_show', $outfit)}}" class="btn btn-info m-2">DAUGIAU</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @empty
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="index-list">
                                    <div class="index-list__extra">
                                        No Outfits
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    {{$outfits->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirm-modal" style="display:none;">
    <div class="card">
        <h5 class="card-header">Confirmation</h5>
        <div class="card-body">
            <h5 class="card-title">Confirm author delete</h5>
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