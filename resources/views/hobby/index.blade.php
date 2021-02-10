@extends('layouts.app')

@section('page_title', 'Hobby')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{-- list-group: -->https://getbootstrap.com/docs/4.0/components/list-group/ --}}
                    {{-- Loop | Foreach -->https://laravel.com/docs/master/blade#loops --}}

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
                            <span class="mx-1">Posted by: {{ $hobby->user->name }}
                                ({{ $hobby->user->hobbies->count() }})</span>
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
                </div>
            </div>
            <div class="mt-2">
                {{ $hobbies->links() }}
            </div>
            @auth
            <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="/hobby/create" role="button"><i class="fas fa-plus-circle"></i>
                    Create new Hobby</a>
            </div>
            @endauth

        </div>
    </div>
</div>

@endsection
