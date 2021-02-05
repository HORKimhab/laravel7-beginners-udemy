@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Starting Page') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                </div>
                @endif

                {{ __('You are logged in!') }} --}}
                Steven Paul Jobs (/dʒɒbz/; February 24, 1955 – October 5, 2011) was an American business magnate,
                industrial designer,
                investor, and media proprietor. He was the chairman, chief executive officer (CEO), and co-founder of
                Apple Inc., the
                chairman and majority shareholder of Pixar, a member of The Walt Disney Company's board of directors
                following its
                acquisition of Pixar, and the founder, chairman, and CEO of NeXT. Jobs is widely recognized as a pioneer
                of the personal
                computer revolution of the 1970s and 1980s, along with Apple co-founder Steve Wozniak.

                Jobs was born in San Francisco, California, and put up for adoption. He was raised in the San Francisco
                Bay Area. He
                attended Reed College in 1972 before dropping out that same year, and traveled through India in 1974
                seeking
                enlightenment and studying Zen Buddhism.
            </div>
        </div>
    </div>
</div>
</div>
@endsection
