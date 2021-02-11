@extends('layouts.app')

@section('page_title', 'Hobby')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col">
            <div class="card">
                <div class="card-header">{{ __('Detail Hobby') }}</div>

                <div class="card-body">
                    {{-- list-group: -->https://getbootstrap.com/docs/4.0/components/list-group/ --}}
                    {{-- Loop | Foreach -->https://laravel.com/docs/master/blade#loops --}}

                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>{{$hobby->name}}</b>
                            <p>{{$hobby->description}}</p>

                            @if($hobby->tags->count() >0)
                            <b>Used Tags: </b><span>(Click to remove)</span>
                            <p class="mb-2">
                                @foreach($hobby->tags as $tag)
                                <a href="/hobby/{{ $hobby->id }}/tag/{{ $tag->id }}/detach"><span
                                        class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                @endforeach
                            </p>
                            @endif

                            @if($availableTags->count() >0)
                            <span><b>Availble Tags: </b>(Click to assign)</span>
                            <p class="mb-0">
                                @foreach($availableTags as $tag)
                                <a href="/hobby/{{ $hobby->id }}/tag/{{ $tag->id }}/attach"><span
                                        class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                @endforeach
                            </p>
                            @endif
                            {{-- <p>
                                @foreach($hobby->tags as $tag)
                                <a href=""><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                            @endforeach
                            </p> --}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                {{-- URL::previous(), https://laravel.com/docs/7.x/urls#accessing-the-current-url --}}
                {{-- <a class="btn btn-secondary btn-sm" href="{{ $paginator->previousPageUrl() }}" role="button"
                title="List all tags"><i class="fas fa-arrow-left"></i>
                Go Previous Page</a> --}}
                <a class="btn btn-info btn-sm" href="/hobby" role="button" title="List all tags"><i
                        class="fas fa-list"></i>
                    All Hobbies</a>
                <a class="btn btn-primary btn-sm" href="/hobby/create" role="button"><i class="fas fa-plus-circle"></i>
                    Create new Hobby</a>
            </div>

        </div>
    </div>
</div>

{{-- <script type="text/javascript">
    document.write(document.referrer);
</script> --}}


@endsection
