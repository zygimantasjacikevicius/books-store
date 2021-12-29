
    <div class="m-4" id="authors--pages">
        {{$authors->links()}}
    </div>
    <div class="container">
        @foreach ($authors->chunk(3) as $chunk)
        <div class="row justify-content-center">
            @foreach ($chunk as $author)
            <div class="col-12">
                <div class="index-list">
                    <div class="index-list__extra">
                       @if ($author->photo)
                       <img src="{{$author->photo}}" alt="">
                       @else
                       <img src="{{asset('img/no-image.png')}}" alt="">
                       @endif
                        
                        
                    </div>
                    <div class="index-list__extra">
                        {{$author->name}} {{$author->surname}}
                    </div>
                    <div class="index-list__content">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Books count:</b> {{$author->getBooks->count()}}
                            </li>
                        </ul>
                    </div>
                    <div class="index-list__buttons">
                        <a href="{{route('author_edit', $author)}}" class="btn btn-success m-2">EDIT</a>
                        <button type="submit" class="delete--button btn btn-danger m-2" @if($author->getBooks->count()) disabled @endif
                            data-action="{{route('author_delete', $author)}}">
                            DELETE</button>
                        <a href="{{route('author_show', $author)}}" class="btn btn-info m-2">MORE</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
