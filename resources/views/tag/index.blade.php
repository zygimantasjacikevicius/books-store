@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-header__wrap">
                        <h1>Tags list</h1>
                        <div class="card-header__wrap__sort">
                            <form action="{{route('tag_index')}}" method="GET">
                                <div class="form-group">
                                    <select name="sort" class="form-control">
                                        <option value="">Sort By</option>
                                        <option value="name_asc" @if('name_asc'==$sort) selected @endif>Name A->Z</option>
                                        <option value="name_desc" @if('name_desc'==$sort) selected @endif>Name Z->A</option>
                                        <option value="new_asc" @if('new_asc'==$sort) selected @endif>New A->Z</option>
                                        <option value="new_desc" @if('new_desc'==$sort) selected @endif>New Z->A</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info m-1">SORT</button>
                                <a href="{{route('tag_index')}}" class="btn btn-warning m-1">RESET</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        @foreach ($tags->chunk(3) as $chunk)
                        <div class="row justify-content-center">
                            @foreach ($chunk as $tag)
                            <div class="col-12">
                                <div class="index-list">
                                    <div class="index-list__extra">
                                        {{$tag->name}}
                                    </div>
                                    <div class="index-list__content">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <b>Books with tag count:</b>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="index-list__buttons">
                                        <a href="{{route('tag_edit', $tag)}}" class="btn btn-success m-2">EDIT</a>
                                        <button type="submit" class="delete--button btn btn-danger m-2"
                                            data-action="{{route('tag_delete', $tag)}}">
                                            DELETE</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
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
            <h5 class="card-title">Confirm tag delete</h5>
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