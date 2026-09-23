<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    private function games()
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'The Legend of Zelda: Breath of the Wild',
                'genre' => 'Action-Adventure',
                'platform' => 'Nintendo'
            ],
            2 => [
                'id' => 2,
                'name' => 'Elden Ring',
                'genre' => 'RPG',
                'platform' => 'PC'
            ],
            3 => [
                'id' => 3,
                'name' => 'Stardew Valley',
                'genre' => 'Simulation',
                'platform' => 'PC'
            ],
            4 => [
                'id' => 4,
                'name' => 'The Witcher 3: Wild Hunt',
                'genre' => 'RPG',
                'platform' => 'PC'
            ],
            5 => [
                'id' => 5,
                'name' => 'Call of Duty: Modern Warfare',
                'genre' => 'Shooter',
                'platform' => 'PC'
            ],
        ];
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

        $genre = $request->query('genre', null);
        $platform = $request->query('platform', null);

        $filtered = collect($games)->filter(function ($game) use ($genre, $platform) {
            $matchGenre = $genre == null || $game['genre'] == $genre;
            $matchPlatform = $platform == null || $game['platform'] == $platform;

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
        //
    }

    public function store(Request $request)
    {
        //
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
