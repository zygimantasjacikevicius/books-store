@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>More about author</h1>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center show-content">
                        <div class="col-4 show-content__block">
                            <span>name:</span>
                            <div>{{$author->name}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span>surname:</span>
                            <div>{{$author->surname}}</div>
                        </div>
                        <div class="col-12 show-content__block">
                            <h4>Books by author</h4>
                            <ul class="list-group">
                                @foreach ($author->getBooks as $book)
                                <li class="list-group-item">{{$book->title}}
                                    <div class="show-content__buttons">
                                        <a href="{{route('book_edit', $book)}}" class="btn btn-success m-2">EDIT</a>
                                        <button type="submit" class="delete--button btn btn-danger m-2" data-action="{{route('book_delete', [$book, 'return' => 'back'])}}">DELETE</button>
                                        <a href="{{route('book_show', $book)}}" class="btn btn-info m-2">MORE</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{route('author_edit', [$author, 'return' => 'show/'.$author->id])}}" class="btn btn-success m-2">EDIT</a>
                        <button type="submit" class="delete--button btn btn-danger m-2" @if($author->getBooks->count()) disabled @endif
                            data-action="{{route('author_delete', $author)}}">
                            DELETE</button>
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
            <h5 class="card-title">Confirm delete</h5>
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