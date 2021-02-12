@extends('layouts.app')

@section('page_title', 'Hobby')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $user->name }}</h3>
                </div>

                <div class="card-body">
                    {{-- list-group: -->https://getbootstrap.com/docs/4.0/components/list-group/ --}}
                    {{-- Loop | Foreach -->https://laravel.com/docs/master/blade#loops --}}

                    <b>My Motto: <br />{{ $user->motto }}</b>
                    <p class="mt-1"><b>About me: </b><br />{{ $user->about_me }}</p>

                    {{-- <p>
@foreach($hobby->tags as $tag)
                                <a href=""><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                    @endforeach
                    </p> --}}
                    <h5>Hobbies of {{ $user->name }}</h5>
                    <ul class="list-group">
                        @if($user->hobbies->count()>0)
                            @foreach($user->hobbies as $hobby)
                                <li class="list-group-item">
                                    {{-- <li class="list-group-item">Cras justo odio</li>
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Morbi leo risus</li>
                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                    --}}

                                    <a href="/hobby/{{ $hobby->id }}" title="Show Details">{{ $hobby->name }}</a>
                                    <span class="float-right mx-1">{{ $hobby->created_at->diffForHumans() }}</span>
                                    <span class="mx-1">Posted by: <a
                                            href="/user/{{ $hobby->user->id }}">{{ $hobby->user->name }}
                                            ({{ $hobby->user->hobbies->count() }})</a>
                                    </span><br />

                                    @foreach($hobby->tags as $tag)
                                        <a href="/hobby/tag/{{ $tag->id }}"><span
                                                class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                    @endforeach

                                </li>
                            @endforeach
                    </ul>
                @else
                    <p>{{ $user->name }} has not created any <mark>hobbies</mark> yet.</p>
                </div>
                @endif
            </div>
            <div class="mt-2">
                {{-- URL::previous(), https://laravel.com/docs/7.x/urls#accessing-the-current-url --}}
                <a class="btn btn-secondary btn-sm" href="{{ URL::previous() }}" role="button"
                    title="List all tags"><i class="fas fa-arrow-left"></i>
                    Go Previous Page</a>
                <a class="btn btn-info btn-sm" href="/hobby" role="button" title="List all tags"><i
                        class="fas fa-list"></i>
                    All Hobbies</a>
                {{-- <a class="btn btn-primary btn-sm" href="/hobby/create" role="button"><i class="fas fa-plus-circle"></i>
                    Create new Hobby</a> --}}
            </div>
        </div>
    </div>
</div>

@endsection
