
    @extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Outfit</div>
                <div class="card-body">
                    <form action="{{ route('outfit_update', $outfit) }}" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                Brands: <select name="brand_id" class="form-control">
                                    <option value="0">Select Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}"
                                       @if ($brand->id == old('brand_id', $outfit->brand_id)) selected @endif >
                                        {{$brand->title}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-4 form-group">
                                Type:<input type="text" class="form-control" name="outfit_type" value="{{old('outfit_type', $outfit->type)}}">
                            </div>
                            <div class="col-4 form-group">
                                Color: <input type="text" class="form-control" name="outfit_color" value="{{old('outfit_color', $outfit->color)}}">
                            </div>
                            <div class="col-4 form-group">
                                Price: <input type="text" class="form-control" name="outfit_price" value="{{old('outfit_price', $outfit->price)}}">
                            </div>
                            <div class="col-12 form-group">
                                Discount: <input type="text" class="form-control" name="outfit_discount" value="{{old('outfit_discount', $outfit->discount)}}">
                            </div>
                            <div class="col-12 form-group">
                                tags:
                                <div class="tags-list">
                                    @forelse ($tags as $tag)
                                    <div class="tags-list__tag">
                                        <input type="checkbox" id="tag-{{$tag->id}}" name="tag[]" value="{{$tag->id}}"
                                        @if (false !== in_array($tag->id, $outfitTags)) checked @endif>
                                        <label for="tag-{{$tag->id}}" class="badge rounded-pill">{{$tag->name}}</label>
                                    </div>
                                    @empty
                                    <h3>No tags</h3>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-12 show-content__block">
                                <span>photos:</span>
                                <div class="images">
                                    @forelse ($outfit->getPhotos as $photo)
                                    <div>
                                    <img src="{{$photo->photo}}">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" name="delete_photo[]" value="{{$photo->id}}">
                                        <label class="form-check-label">
                                            delete photo
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" class="form-check-input" name="main_photo" value="{{$photo->id}}"
                                        @if($photo->main) checked @endif>
                                        <label class="form-check-label">
                                            Set as Main
                                        </label>
                                    </div>
                                    </div>
                                    @empty
                                    <h3>No photos</h3>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                photos of outfit:
                                <div class="outfit--photos outfit-photo-form">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-success mt-2 add--photo--outfit">Add photo</button>
                                <button type="submit" class="btn btn-success mt-2">Edit Outfit</button>
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