@extends('layouts.app')

@section('title', 'Game Recommendations')

@section('content')
    @include('partials._nav')
    <h2 class="mb-3">List of Games</h2>


    {{-- B5: state which filters are currently active --}}
    <div class="mb-3">
        @if ($genre == '' && $platform == '')
            <span class="badge bg-secondary">Showing all games</span>
        @else
            <span class="badge bg-primary">
                @if ($genre != '')
                    {{ $genre }}
                @else
                    any genre
                @endif
                ,
                @if ($platform != '')
                    {{ $platform }}
                @else
                    any platform
                @endif
            </span>
            {{-- B3: clear both filters at once --}}
            <a href="{{ route('games.index') }}" class="btn btn-sm btn-outline-secondary ms-2">Clear Filter</a>

            <a href="{{ route('games.create') }}" class="btn btn-sm btn-outline-secondary ms-2">Add Game</a>

        @endif
    </div>

    {{-- B1/B2/B4: every link passes BOTH current values, so switching one
    filter keeps the other one applied. --}}
    <div class="mb-2">
        <strong>Genre:</strong>
        <a href="{{ route('games.index', ['genre' => '', 'platform' => $platform]) }}"
            class="btn btn-sm btn-outline-primary">All</a>
        @foreach ($genres as $g)
            <a href="{{ route('games.index', ['genre' => $g, 'platform' => $platform]) }}"
                class="btn btn-sm btn-outline-primary">{{ $g }}</a>
        @endforeach
    </div>

    <div class="mb-3">
        <strong>Platform:</strong>
        <a href="{{ route('games.index', ['genre' => $genre, 'platform' => '']) }}"
            class="btn btn-sm btn-outline-secondary">All</a>
        @foreach ($platforms as $p)
            <a href="{{ route('games.index', ['genre' => $genre, 'platform' => $p]) }}"
                class="btn btn-sm btn-outline-secondary">{{ $p }}</a>
        @endforeach
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Platform</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($games as $game)
                <tr>
                    <td>
                        <a href="{{ route('games.show', ['game' => $game['id']]) }}">
                            {{ $loop->iteration }}
                        </a>
                    </td>
                    <td>{{ $game['name'] }}</td>
                    <td>
                        {{-- B2: keeps the current platform filter when jumping via the genre --}}
                        <a href="{{ route('games.index', ['genre' => $game['genre'], 'platform' => $platform]) }}">
                            {{ $game['genre'] }}
                        </a>
                    </td>
                    <td>{{ $game['platform'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Games Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
