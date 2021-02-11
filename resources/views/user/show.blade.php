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
                            <h1>{{$user->name}}</h1>
                            <b>{{$user->motto}}</b>
                            <p>{{$user->about_me}}</p>
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
                <a class="btn btn-secondary btn-sm" href="{{ URL::previous() }}" role="button" title="List all tags"><i
                        class="fas fa-arrow-left"></i>
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
