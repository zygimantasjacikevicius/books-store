@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>Edit book</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('book_update', $book) }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4 form-group">
                                title:<input type="text" class="form-control" name="book_title" value="{{old('book_title', $book->title)}}">
                            </div>
                            <div class="col-4 form-group">
                                ISBN: <input type="text" class="form-control" name="book_isbn" value="{{old('book_isbn',$book->isbn)}}">
                            </div>
                            <div class="col-4 form-group">
                                pages: <input type="text" class="form-control" name="book_pages" value="{{old('book_pages',$book->pages)}}">
                            </div>
                            <div class="col-6 form-group">
                                authors: <select name="author_id" class="form-control">
                                    <option value="0">Select author</option>
                                    @foreach ($authors as $author)
                                    <option value="{{$author->id}}" @if($author->id == old('author_id', $book->author_id)) selected @endif>
                                        {{$author->name}} {{$author->surname}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                about: <textarea name="book_about" class="form-control">{{old('book_about',$book->about)}}</textarea>
                            </div>
                            <div class="col-12 form-group">
                                tags:
                                <div class="tags-list">
                                    @forelse ($tags as $tag)
                                    <div class="tags-list__tag">
                                        <input type="checkbox" id="tag-{{$tag->id}}" name="tag[]" value="{{$tag->id}}"
                                        @if (false !== in_array($tag->id, $bookTags)) checked @endif>
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
                                    @forelse ($book->getPhotos as $photo)
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
                                photos of book:
                                <div class="book--photos book-photo-form">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-success mt-2 add--photo">Add photo</button>
                                <button type="submit" class="btn btn-success mt-2">Edit Book</button>
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