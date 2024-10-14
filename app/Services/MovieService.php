<?php

namespace App\Services;


use App\Models\Movie;
use App\Repositories\MovieRepository;
use Illuminate\Support\Collection;

class MovieService
{
    public function __construct(
        protected MovieRepository $repository
    )
    {
    }

    public function getAll(): Collection {
        return $this->repository->getAll();
    }

    public function store(array $values): Movie
    {
        return $this->repository->store($values);
    }

    public function update(array $values, Movie $movie): Movie
    {
        return $this->repository->update($movie, $values);
    }

    public function delete(Movie $movie): void {
        $this->repository->delete($movie);
    }
}
