@extends('layouts.app')

@section('page_title', 'Create a new tag')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create New Tag</div>
                <div class="card-body">
                    <form action="/tag" method="POST">
                        @csrf {{-- 01 --}}

                        {{-- Equaivalent to 01 --}}
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

                        <div class="form-group">
                            <label for="name">Name</label>
                            {{-- https://laravel.com/docs/7.x/validation#working-with-error-messages --}}
                            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}"
                                id="name" name="name" value="{{ old('name') }}">
                            <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="style">Style</label>
                            <input class="form-control {{ $errors->has('style') ? 'border-danger': '' }}" id="style"
                                name="style" value="{{ $tag->style ?? old('style') }}">
                            <small>
                                <mark>Learn Styles&nbsp;</mark>
                                <i class="fas fa-arrow-right"></i>
                                <a href="https://getbootstrap.com/docs/4.5/utilities/colors/" target="_blank"
                                    title="To learn more styles bootstrap">&nbsp;Know more
                                    styles</a>
                            </small>
                            <small class="form-text text-danger">{!! $errors->first('style') !!}</small>
                        </div>
                        <a class="btn btn-secondary mt-4" href="/tag"><i class="fas fa-arrow-left"></i>
                            Back</a>
                        <input class="btn btn-primary mt-4" type="submit" value="Save tag">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
