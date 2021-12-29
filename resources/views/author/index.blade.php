@extends('layouts.app')
@section('content')
<div id="authors"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-header__wrap">
                    <h1>Authors list</h1>
                    <div class="card-header__wrap__sort">
                        <form action="{{route('author_index')}}" method="GET">
                            <div class="form-group">
                            <select name="sort" class="form-control" id="sort-select">
                                <option value="">Sort by</option>
                                <option value="asc" >Name A->Z</option>
                                <option value="desc" >Name Z->A</option>
                                <option value="new_asc" >New A->Z</option>
                                <option value="new_desc" >New Z->A</option>
                                
                            </select>
                        </div>
                            <button type="submit" class=" btn btn-info m-2" >SORT</button>
                            <a href="{{route('author_index')}}" class="btn btn-success m-2">RESET</a>
                        </form>
                    </div>
                </div>
                
                </div>
                <div class="card-body" id="authors--list" data-url="{{route('author_list')}}">
                    <div class="loader">Loading...</div>
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