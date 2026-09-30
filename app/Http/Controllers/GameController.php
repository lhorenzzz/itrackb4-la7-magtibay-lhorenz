<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    private function games()
    {
        $path = storage_path('app/games.json');

        return json_decode(file_get_contents($path), true);
    }

    private function saveGames(array $games)
    {
        file_put_contents(
            storage_path('app/games.json'),
            json_encode($games, JSON_PRETTY_PRINT)
        );
    }

    public function filter(string $value = null)
    {
        if (is_null($value)) {
            return redirect()->route('games.index');
        }
        return redirect()->route('games.index', ['genre' => $value]);
    }

    public function index(Request $request)
    {
        $games = $this->games();

        $genre = $request->query('genre', 'all');
        $platform = $request->query('platform', 'all');

        $filtered = collect($games)->filter(function ($game) use ($genre, $platform) {
            $matchGenre = $genre == 'all' || $game['genre'] == $genre;
            $matchPlatform = $platform == 'all' || $game['platform'] == $platform;

            return $matchGenre && $matchPlatform;
        });

        return view('games.index', [
            'games' => $filtered,
            'genre' => $genre ?? '',
            'platform' => $platform ?? '',
            'genres' => collect($games)->pluck('genre')->unique()->values(),
            'platforms' => collect($games)->pluck('platform')->unique()->values(),
        ]);
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'genre' => 'required|in:Action-Adventure,RPG,Simulation,Shooter',
            'platform' => 'required|in:PC,PlayStation,Xbox,Nintendo Switch',
        ]);

        $games = $this->games();
        $newId = count($games) + 1;
        $games[$newId] = [
            'id' => $newId,
            'name' => $validatedData['name'],
            'genre' => $validatedData['genre'],
            'platform' => $validatedData['platform'],
        ];

        $this->saveGames($games);

        return redirect()->route('games.index')->with('success', 'Game created successfully!');
    }

    public function show(string $id)
    {
        $games = $this->games();

        if (!isset($games[$id])) {
            abort(404);
        }
        return view('games.show', ['game' => $games[$id]]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function featured()
    {
        $games = $this->games();
        return view('games.show', ['game' => $games[1]]);
    }

    public function favorite()
    {
        $games = $this->games();
        return view('games.show', ['game' => $games[2]]); // pick whichever game you want as "favorite"
    }
}
