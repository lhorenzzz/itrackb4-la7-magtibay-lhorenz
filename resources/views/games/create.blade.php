@extends('layouts.app')
@section('title', 'Add Game')
@section('content')
    <br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-4">Add a New Game</h3>

            <form action="{{ route('games.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Game Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <select name="genre" id="genre" class="form-select @error('genre') is-invalid @enderror">
                        <option value="">Select Genre</option>
                        <option value="Action-Adventure" {{ old('genre') == 'Action-Adventure' ? 'selected' : '' }}>
                            Action-Adventure</option>
                        <option value="RPG" {{ old('genre') == 'RPG' ? 'selected' : '' }}>RPG</option>
                        <option value="Simulation" {{ old('genre') == 'Simulation' ? 'selected' : '' }}>Simulation</option>
                        <option value="Strategy" {{ old('genre') == 'Shooter' ? 'selected' : '' }}>Shooter</option>
                    </select>
                    @error('genre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="platform" class="form-label">Platform</label>
                    <select name="platform" id="platform" class="form-select @error('platform') is-invalid @enderror">
                        <option value="">Select Platform</option>
                        <option value="PC" {{ old('platform') == 'PC' ? 'selected' : '' }}>PC</option>
                        <option value="PlayStation" {{ old('platform') == 'PlayStation' ? 'selected' : '' }}>PlayStation
                        </option>
                        <option value="Xbox" {{ old('platform') == 'Xbox' ? 'selected' : '' }}>Xbox</option>
                        <option value="Nintendo Switch" {{ old('platform') == 'Nintendo Switch' ? 'selected' : '' }}>Nintendo
                            Switch</option>

                    </select>
                    @error('platform')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year"
                        value="{{ old('year') }}">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Game</button>
                <a class="btn btn-secondary" href="{{ route('games.index') }}">Back to the list</a>

            </form>
            <!-- Game creation form would go here -->
        </div>
    </div>
@endsection
