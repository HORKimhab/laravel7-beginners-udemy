@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Hobby</div>
                <div class="card-body">
                    <form autocomplete="off" action="/hobby/{{ $hobby->id }}" method="POST"
                        enctype="multipart/form-data">
                        {{-- More: https://laravel.com/docs/7.x/routing#form-method-spoofing --}}
                        @method('PUT')
                        @csrf {{-- 01 --}}

                        {{-- Equaivalent to 01 --}}
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

                        <div class="form-group">
                            <label for="name">Name</label>
                            {{-- https://laravel.com/docs/7.x/validation#working-with-error-messages --}}
                            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}"
                                id="name" name="name" value="{{ $hobby->name ?? old('name') }}">
                            <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'border-danger': '' }}"
                                id="description" name="description" value=" "
                                rows="5">{{ old('description') }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'border-danger': '' }}"
                                id="description" name="description" value=""
                                rows="5">{{ $hobby->description ?? old('description') }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                        </div>
                        <a class="btn btn-secondary mt-4" href="/hobby"><i class="fas fa-arrow-left"></i>
                            Back</a>
                        <input class="btn btn-primary mt-4" type="submit" value="Save hobby">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
