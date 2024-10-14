<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Support\Collection;

class MovieRepository
{
    public function getAll(): Collection {
        return Movie::all();
    }

    public function store($values): Movie {
        return Movie::create($values);
    }

    public function update(Movie $movie, array $values): Movie {
        return tap($movie)->update($values);
    }

    public function delete(Movie $movie): void {
        $movie->delete();
    }


}
