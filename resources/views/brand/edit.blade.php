@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h1>Edit Brand</h1></div>
                <div class="card-body">
                    <form action="{{ route('brand_update', $brand) }}" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                name:<input type="text" class="form-control" name="brand_title" value="{{old('brand_title', $brand->title)}}">
                            </div>
                            <div class="col-3 enter-image">
                                @if ($brand->photo)
                                <img src="{{$brand->photo}}">
                                @else
                                <img src="{{asset('img/no-image.png')}}">
                                @endif
                            </div>
                            <div class="col-8 form-group">
                                portret: <input type="file" class="form-control" name="brand_photo">
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="delete_photo">
                                <label class="form-check-label">
                                    delete photo
                                </label>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-2">Edit Brand</button>
                            </div>
                        </div>
                        @method('PUT')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection