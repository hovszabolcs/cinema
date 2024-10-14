<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\MovieCollectionResource;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Services\MovieService;
use Symfony\Component\HttpFoundation\JsonResponse;

final class MovieController extends Controller
{
    public function __construct(
        private readonly MovieService $movieService
    )
    {}

    public function index(): MovieCollectionResource
    {
        return new MovieCollectionResource($this->movieService->getAll());
    }

    public function store(StoreMovieRequest $request): JsonResponse
    {
        return (
            new MovieResource(
                $this->movieService->store($request->all())
            )
        )->response()->setStatusCode(201);
    }

    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie);
    }


    public function update(StoreMovieRequest $request, Movie $movie): MovieResource
    {
        return new MovieResource($this->movieService->update($request->all(), $movie));
    }

    public function destroy(Movie $movie)
    {
        $this->movieService->delete($movie);
        return (new BaseResource([]))->response()->setStatusCode( 204);
    }
}

