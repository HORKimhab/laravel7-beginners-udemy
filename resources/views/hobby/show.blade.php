@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Hobby Detail</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <b>{{$hobby->name}}</b>
                            <p>{{$hobby->description}}</p>
                            @if($hobby->tags->count() > 0)
                            <b>Used Tags:</b> (Click to remove)
                            <p>
                                @foreach($hobby->tags as $tag)
                                <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/detach"><span
                                        class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                @endforeach
                            </p>
                            @endif

                            @if($availableTags->count() > 0)
                            <b>Available Tags:</b> (Click to assign)
                            <p>
                                @foreach($availableTags as $tag)
                                <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/attach"><span
                                        class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                @endforeach
                            </p>
                            @endif
                        </div>
                        <div class="col-md-3">
                            @if(Auth::user() && file_exists('img/hobbies/' . $hobby->id . '_large.jpg'))
                            <a href="/img/hobbies/{{ $hobby->id }}_large.jpg"
                                data-lightbox="/img/hobbies/{{ $hobby->id }}_large.jpg" data-title="{{ $hobby->name }}">
                                <img class="img-fluid" src="/img/hobbies/{{ $hobby->id }}_large.jpg" alt=""
                                    style="cursor: zoom-in">
                            </a>
                            {{-- <i class="fa fa-search-plus"></i> --}}

                            {{-- .img-fluid
                                Images in Bootstrap are made responsive with .img-fluid. max-width: 100%; and height: auto;
                                are applied to the image so that it scales with the parent element.
                                URL: https://getbootstrap.com/docs/4.5/content/images/
                            --}}

                            @elseif(!Auth::user() && file_exists('img/hobbies/' . $hobby->id . '_pixelated.jpg'))
                            <a href="/img/hobbies/{{ $hobby->id }}_pixelated.jpg"
                                data-lightbox="/img/hobbies/{{ $hobby->id }}_pixelated.jpg"
                                data-title="{{ $hobby->name }}">
                                <img class="img-fluid" src="/img/hobbies/{{ $hobby->id }}_pixelated.jpg" alt=""
                                    style="cursor: zoom-in">
                            </a>
                            @else
                            <a href="/img/400x300.jpg" data-lightbox="400x300.jpg" data-title="{{ $hobby->name }}">
                                <img class="img-fluid" src="/img/400x300.jpg" alt="">
                            </a>
                            <i class="fa fa-search-plus"></i> Click image to enlarge
                            @endif
                            <span>{{ $hobby->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--
                <div class="mt-2">
                    <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Back to Overview</a>
                </div>
                -->
        </div>
    </div>
</div>
@endsection
