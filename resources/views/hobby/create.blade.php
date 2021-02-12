@extends('layouts.app')

@section('page_title', 'Create a new hobby')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create New Hobby</div>
                <div class="card-body">
                    <form autocomplete="off" action="/hobby" method="POST" enctype="multipart/form-data">
                        {{-- enctype="multipart/form-data": https://www.w3schools.com/tags/att_form_enctype.asp --}}
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
                            <label for="image">Image</label>
                            {{-- https://laravel.com/docs/7.x/validation#working-with-error-messages --}}
                            <input type="file" class="form-control {{ $errors->has('image') ? 'border-danger' : ''}}"
                                id="image" name="image" value=" ">
                            <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'border-danger': '' }}"
                                id="description" name="description" value=" "
                                rows="5">{{ old('description') }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="Save Hobby">
                    </form>
                    <a class="btn btn-primary float-right" href="/hobby"><i class="fas fa-arrow-circle-up"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
