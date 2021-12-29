@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h1>Create brand</h1></div>
                <div class="card-body">
                    <form action="{{ route('brand_store') }}" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                name:<input type="text" class="form-control" name="brand_title" value="{{old('brand_title')}}">
                            </div>
                            <div class="col-12 form-group">
                                Portret: <input type="file" class="form-control" name="brand_photo" >
                            </div>
                                <button type="submit" class="btn btn-success mt-2">New Brand</button>
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