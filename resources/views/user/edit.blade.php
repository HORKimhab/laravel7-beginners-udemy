@extends('layouts.app')

@section('page_title', 'Edit User ' . $user->id)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit user</div>
                <div class="card-body">
                    <form autocomplete="off" action="/user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        {{-- More: https://laravel.com/docs/7.x/routing#form-method-spoofing --}}
                        @method('PUT')
                        @csrf {{-- 01 --}}

                        {{-- Equaivalent to 01 --}}
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

                        <div class="form-group">
                            <label for="name">Name</label>
                            {{-- https://laravel.com/docs/7.x/validation#working-with-error-messages --}}
                            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}"
                                id="name" name="name" value="{{ $user->name ?? old('name') }}">
                            <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                        </div>

                        @if(file_exists('img/users/' . $user->id . '_large.jpg'))
                        <div class="mb-2">
                            <img style="max-width: 400px; max-height: 300px;" src="/img/users/{{ $user->id }}_large.jpg"
                                alt="user Thumb Not Found">
                            <a class="btn btn-outline-danger float-right" href="/delete-image/user/{{ $user->id }}"
                                onclick="return confirm('Are you sure to delete this image?');">
                                Delete</a>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="image">Image</label>
                            {{-- https://laravel.com/docs/7.x/validation#working-with-error-messages --}}
                            <input type="file" class="form-control {{ $errors->has('image') ? 'border-danger' : ''}}"
                                id="image" name="image" value=" {{ $user->image ?? old('image') }}"
                                title="Choose a new image to update">
                            <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                        </div>

                        <div class="form-group">
                            <label for="motto">Motto</label>
                            {{-- https://laravel.com/docs/7.x/validation#working-with-error-messages --}}
                            <input type="text" class="form-control {{ $errors->has('motto') ? 'border-danger' : ''}}"
                                id="motto" name="motto" value="{{ $user->motto ?? old('motto') }}">
                            <small class="form-text text-danger">{!! $errors->first('motto') !!}</small>
                        </div>

                        <div class="form-group">
                            <label for="about_me">About me</label>
                            <textarea class="form-control {{ $errors->has('about_me') ? 'border-danger': '' }}"
                                id="about_me" name="about_me" value=""
                                rows="5">{{ $user->about_me ?? old('about_me') }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('about_me') !!}</small>
                        </div>
                        <a class="btn btn-secondary mt-4" href="/user"><i class="fas fa-arrow-left"></i>
                            Back</a>
                        <input class="btn btn-primary mt-4" type="submit" value="Save user">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
