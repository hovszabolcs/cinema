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
    /**
     * @OA\Get(
     *      path="/api/v1/movies",
     *      tags={"Movies"},
     *      summary="List all movies",
     *      description="Retrieve a list of all movies with their details",
     *      operationId="listMovies",
     *      security={{"bearer_token":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="List of movies",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Movie")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      )
     *  )
     */
    public function index(): MovieCollectionResource
    {
        return new MovieCollectionResource($this->movieService->getAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/movies",
     *     tags={"Movies"},
     *     summary="Create a new movie",
     *     description="Create a new movie with the required details",
     *     operationId="createMovie",
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description", "age_classification", "lang", "image_path"},
     *             @OA\Property(property="title", type="string", maxLength=120, example="New Movie"),
     *             @OA\Property(property="description", type="string", example="This is a movie description."),
     *             @OA\Property(property="age_classification", type="integer", enum={12,16,18}, example=16),
     *             @OA\Property(property="lang", type="string", maxLength=20, example="en"),
     *             @OA\Property(property="image_path", type="string", format="url", example="https://example.com/movie.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Movie created",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function store(StoreMovieRequest $request): JsonResponse
    {
        return (
            new MovieResource(
                $this->movieService->store($request->all())
            )
        )->response()->setStatusCode(201);
    }
    /**
     * @OA\Get(
     *     path="/api/v1/movies/{id}",
     *     tags={"Movies"},
     *     summary="Retrieve a single movie",
     *     description="Fetch a specific movie by its ID",
     *     operationId="getMovie",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie details",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie);
    }

    /**
     * @OA\Patch(
     *     path="/api/v1/movies/{id}",
     *     tags={"Movies"},
     *     summary="Update an existing movie",
     *     description="Update the details of an existing movie",
     *     operationId="updateMovie",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description", "age_classification", "lang", "image_path"},
     *             @OA\Property(property="title", type="string", maxLength=120, example="Updated Movie Title"),
     *             @OA\Property(property="description", type="string", example="Updated description."),
     *             @OA\Property(property="age_classification", type="integer", enum={12,16,18}, example=18),
     *             @OA\Property(property="lang", type="string", maxLength=20, example="fr"),
     *             @OA\Property(property="image_path", type="string", format="url", example="https://example.com/updated_movie.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie updated",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function update(StoreMovieRequest $request, Movie $movie): MovieResource
    {
        return new MovieResource($this->movieService->update($request->all(), $movie));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/movies/{id}",
     *     tags={"Movies"},
     *     summary="Delete a movie",
     *     description="Delete a movie by its ID",
     *     operationId="deleteMovie",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Movie deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function destroy(Movie $movie)
    {
        $this->movieService->delete($movie);
        return (new BaseResource([]))->response()->setStatusCode( 204);
    }
}

