<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    private function books()
    {
        return [
            1 => ['id' => 1, 'title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien', 'year' => '1950', 'genre' => 'Classical'],
            2 => ['id' => 2, 'title' => 'Spiderman', 'author' => 'Lhorenz', 'year' => '2011', 'genre' => 'Mystery'],
            3 => ['id' => 3, 'title' => 'The Return of the King', 'author' => 'Khaliq', 'year' => '1954', 'genre' => 'Historical'],
            4 => ['id' => 4, 'title' => 'World of Warcraft', 'author' => 'Lenard', 'year' => '2000', 'genre' => 'Historical'],
            5 => ['id' => 5, 'title' => 'The Hobbit', 'author' => 'Justin', 'year' => '1954', 'genre' => 'Classical'],
            6 => ['id' => 6, 'title' => 'The World of Computers', 'author' => 'Mikko', 'year' => '2010', 'genre' => 'Mystery'],
            7 => ['id' => 7, 'title' => 'Programmer', 'author' => 'Lhorenz', 'year' => '1978', 'genre' => 'Historical'],
        ];
    }

    // A1/A2/A3/A4/A5/A6: one route, two query-string values, each with a
    // sensible default (''), applied independently and together.
    public function index(Request $request)
    {
        $genre = $request->query('genre', '');
        $year  = $request->query('year', '');

        $allBooks = $this->books();
        $books = [];

        foreach ($allBooks as $book) {
            if ($genre != '' && $book['genre'] != $genre) {
                continue;
            }
            if ($year != '' && $book['year'] != $year) {
                continue;
            }
            $books[] = $book;
        }

        // build the lists used for the filter links (B1)
        $genres = [];
        $years = [];
        foreach ($allBooks as $book) {
            if (!in_array($book['genre'], $genres)) {
                $genres[] = $book['genre'];
            }
            if (!in_array($book['year'], $years)) {
                $years[] = $book['year'];
            }
        }
        sort($genres);
        sort($years);

        return view('books.index', [
            'books'  => $books,
            'genre'  => $genre,
            'year'   => $year,
            'genres' => $genres,
            'years'  => $years,
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
        $books = $this->books();

        if (!isset($books[$id])) {
            abort(404);
        }

        return view('books.show', ['book' => $books[$id]]);
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

    public function feature()
    {
        $books = $this->books();

        return view('books.feature', ['book' => $books[1]]);
    }

    // C2/C3/C4: replaces the old filter() method. Renders nothing itself —
    // carries the old genre value across and redirects into the new
    // query-string version of the list.
    public function redirectOldFilter(?string $genre = null)
    {
        if ($genre) {
            return redirect()->route('books.index', ['genre' => $genre]);
        }

        return redirect()->route('books.index');
    }
}
