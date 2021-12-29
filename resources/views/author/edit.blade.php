@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>Edit author</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('author_update', [$author, 'return' => $return]) }}" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                name:<input type="text" class="form-control" name="author_name" value="{{old('author_name', $author->name)}}">
                            </div>
                            <div class="col-6 form-group">
                                surname: <input type="text" class="form-control" name="author_surname" value="{{old('author_surname', $author->surname)}}">
                            </div>
                            <div class="col-3 enter-image">
                                @if ($author->photo)
                                <img src="{{$author->photo}}">
                                @else
                                <img src="{{asset('img/no-image.png')}}">
                                @endif
                            </div>
                            <div class="col-8 form-group">
                                portret: <input type="file" class="form-control" name="author_photo">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" name="delete_photo">
                                    <label class="form-check-label">
                                        delete photo
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-2">Edit Author</button>
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