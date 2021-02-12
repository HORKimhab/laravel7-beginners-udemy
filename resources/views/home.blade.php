@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h2>Hello {{ auth()->user()->name }}</h2>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @auth
                    <ul class="list-group">
                        @foreach($hobbies as $hobby)
                        {{-- <li class="list-group-item">Cras justo odio</li>
                                                    <li class="list-group-item">Dapibus ac facilisis in</li>
                                                    <li class="list-group-item">Morbi leo risus</li>
                                                    <li class="list-group-item">Porta ac consectetur ac</li>
                                                    <li class="list-group-item">Vestibulum at eros</li> --}}
                        <li class="list-group-item">
                            <a href="/hobby/{{$hobby->id}}" title="Show Details">{{ $hobby->name }}</a>
                            @auth {{-- Need login to see these feature --}}
                            <a href="/hobby/{{$hobby->id}}/edit" title="Click to Edit Hobby"
                                class="btn btn-light ml-1"><i class="far fa-edit"></i> Edit
                                Hobby</a>
                            @endauth
                            <span class="mx-1">Posted by: <a
                                    href="/user/{{ $hobby->user->id }}">{{ $hobby->user->name }}</a>
                                ({{ $hobby->user->hobbies->count() }})</span><br />
                            @foreach($hobby->tags as $tag)
                            <a href="/hobby/tag/{{ $tag->id }}"><span
                                    class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                            @endforeach
                            @auth
                            <form action="/hobby/{{$hobby->id}}" method="POST" class="float-right">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-outline-danger" type="submit" value="Delete">
                            </form>
                            @endauth
                            <span class="float-right mx-1">{{ $hobby->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>

                    {{-- {{ __('You are logged in!') }}<br /> --}}
                    <a class="btn btn-primary btn-sm mt-1" href="/hobby/create" role="button"><i
                            class="fas fa-plus-circle"></i>
                        Create new Hobby</a>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
