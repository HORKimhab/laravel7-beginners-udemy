@extends('layouts.app')

@section('page_title', 'All Tags')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{-- list-group: -->https://getbootstrap.com/docs/4.0/components/list-group/ --}}
                    {{-- Loop | Foreach -->https://laravel.com/docs/master/blade#loops --}}

                    <ul class="list-group">
                        @foreach($tags as $tag)
                        {{-- <li class="list-group-item">Cras justo odio</li>
                            <li class="list-group-item">Dapibus ac facilisis in</li>
                            <li class="list-group-item">Morbi leo risus</li>
                            <li class="list-group-item">Porta ac consectetur ac</li>
                            <li class="list-group-item">Vestibulum at eros</li> --}}
                        <li class="list-group-item">
                            <span style="font-size: 130%" class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                            {{-- <a href="/tag/{{$tag->id}}" title="Show Details">{{ $tag->name }}</a> --}}

                            {{-- @auth --}}

                            @can('update', $tag)
                            {{-- https://laravel.com/docs/7.x/authorization#via-blade-templates --}}
                            <a href="/tag/{{$tag->id}}/edit" title="Click to Edit tag"
                                class="btn btn-outline-primary ml-1"><i class="far fa-edit"></i> Edit
                                tag</a>
                            @endcan

                            @can('delete', $tag)
                            {{-- https://laravel.com/docs/7.x/authorization#via-blade-templates --}}
                            <form action="/tag/{{$tag->id}}" method="POST" class="float-right">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-outline-danger" type="submit" value="Delete">
                            </form>
                            {{-- @endauth --}}
                            @endcan

                            <a class="float-right mx-1" href="/hobby/tag/{{ $tag->id }}">Used
                                {{ $tag->hobbies->count() }}
                                times</a>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                {{-- @auth --}}
                @can('create', $tag)
                {{-- https://laravel.com/docs/7.x/authorization#via-blade-templates --}}
                <a class="btn btn-primary btn-sm" href="/tag/create" role="button"><i class="fas fa-plus-circle"></i>
                    Create new tag</a>
                {{-- @endauth --}}
                @endcan
            </div>

        </div>
    </div>
</div>

@endsection
