@extends('layouts.app')
@section('title', 'Game Details')

@section('content')
    @include('partials._nav')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $game['name'] }}</h3>
            <p>Genre: {{ $game['genre'] }}</p>
            <p>Platform: {{ $game['platform'] }}</p>

            <a class="btn btn-primary" href="{{ route('games.index') }}">Back to the list</a>
        </div>
    </div>
@endsection
