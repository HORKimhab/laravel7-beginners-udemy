@extends('layouts.app')

@section('page_title', 'Show detail tag')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Tag') }}</div>

                <div class="card-body">
                    {{-- list-group: -->https://getbootstrap.com/docs/4.0/components/list-group/ --}}
                    {{-- Loop | Foreach -->https://laravel.com/docs/master/blade#loops --}}

                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>{{$tag->name}}</b>
                            <p>{{$tag->style}}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="/tag/create" role="button" title="Create a new tag"><i
                        class="fas fa-plus-circle"></i>
                    Create new tag</a>
                <a class="btn btn-secondary btn-sm" href="/tag" role="button" title="List all tags"><i
                        class="fas fa-list"></i>
                    All Tags</a>
            </div>

        </div>
    </div>
</div>

@endsection
