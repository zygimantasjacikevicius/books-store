@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>Create book</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('book_store') }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4 form-group">
                                title:<input type="text" class="form-control" name="book_title" value="{{old('book_title')}}">
                            </div>
                            <div class="col-4 form-group">
                                ISBN: <input type="text" class="form-control" name="book_isbn" value="{{old('book_isbn')}}">
                            </div>
                            <div class="col-4 form-group">
                                pages: <input type="text" class="form-control" name="book_pages" value="{{old('book_pages')}}">
                            </div>
                            <div class="col-6 form-group">
                                authors: <select name="author_id" class="form-control">
                                    <option value="0">Select author</option>
                                    @foreach ($authors as $author)
                                    <option value="{{$author->id}}" @if(old('author_id')==$author->id) selected @endif>
                                        {{$author->name}} {{$author->surname}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                about: <textarea name="book_about" class="form-control">{{old('book_about')}}</textarea>
                            </div>
                            <div class="col-12 form-group">
                                tags:
                                <div class="tags-list">
                                    @forelse ($tags as $tag)
                                    <div class="tags-list__tag">
                                        <input type="checkbox" id="tag-{{$tag->id}}" name="tag[]" value="{{$tag->id}}">
                                        <label for="tag-{{$tag->id}}" class="badge rounded-pill">{{$tag->name}}</label>
                                    </div>
                                    @empty
                                    <h3>No tags</h3>
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
                                <button type="submit" class="btn btn-success mt-2">New Book</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection