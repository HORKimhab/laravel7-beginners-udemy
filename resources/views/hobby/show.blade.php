@extends('layouts.app')

@section('page_title', 'Hobby')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Hobby') }}</div>

                <div class="card-body">
                    {{-- list-group: -->https://getbootstrap.com/docs/4.0/components/list-group/ --}}
                    {{-- Loop | Foreach -->https://laravel.com/docs/master/blade#loops --}}

                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>{{$hobby->name}}</b>
                            <p>{{$hobby->description}}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="/hobby/create" role="button"><i class="fas fa-plus-circle"></i>
                    Create new Hobby</a>
            </div>

        </div>
    </div>
</div>

@endsection
