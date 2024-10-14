<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScreeningRequest;
use App\Http\Resources\ScreeningCollectionResource;
use App\Http\Resources\ScreeningResource;
use App\Models\Screening;
use App\Services\ScreeningService;
use Illuminate\Http\JsonResponse;

class ScreeningController extends Controller
{
    public function __construct(
        private readonly ScreeningService $screeningService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/v1/screenings",
     *     tags={"Screenings"},
     *     summary="List all screenings",
     *     description="Retrieve a list of all screenings",
     *     operationId="listScreenings",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of screenings",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Screening")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index(): ScreeningCollectionResource
    {
        return new ScreeningCollectionResource($this->screeningService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/v1/screenings",
     *     tags={"Screenings"},
     *     summary="Create a new screening",
     *     description="Create a new screening with the required details",
     *     operationId="createScreening",
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"start", "seats_available", "url", "movie_id"},
     *             @OA\Property(property="start", type="string", maxLength=120, example="2024-10-14 12:00:00"),
     *             @OA\Property(property="seats_available", type="integer", example=100),
     *             @OA\Property(property="url", type="string", maxLength=255, example="https://example.com/screening"),
     *             @OA\Property(property="movie_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Screening created",
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
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
    public function store(StoreScreeningRequest $request): JsonResponse
    {
        return (
            new ScreeningResource(
                $this->screeningService->store($request->all())
        )
        )->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/v1/screenings/{id}",
     *     tags={"Screenings"},
     *     summary="Retrieve a single screening",
     *     description="Fetch a specific screening by its ID",
     *     operationId="getScreening",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Screening details",
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Screening not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function show(Screening $screening): ScreeningResource
    {
        return new ScreeningResource($screening);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Patch(
     *     path="/api/v1/screenings/{id}",
     *     tags={"Screenings"},
     *     summary="Update an existing screening",
     *     description="Update the details of an existing screening",
     *     operationId="updateScreening",
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
     *             required={"start", "seats_available", "url", "movie_id"},
     *             @OA\Property(property="start", type="string", maxLength=120, example="2024-10-14 12:00:00"),
     *             @OA\Property(property="seats_available", type="integer", example=90),
     *             @OA\Property(property="url", type="string", maxLength=255, example="https://example.com/updated_screening"),
     *             @OA\Property(property="movie_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Screening updated",
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Screening not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function update(StoreScreeningRequest $request, Screening $screening): ScreeningResource
    {
        return new ScreeningResource($this->screeningService->update($request->all(), $screening));
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete(
     *     path="/api/v1/screenings/{id}",
     *     tags={"Screenings"},
     *     summary="Delete a screening",
     *     description="Delete a screening by its ID",
     *     operationId="deleteScreening",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Screening deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Screening not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function destroy(Screening $screening)
    {
        $screening->delete();
        return response()->json(null, 204);
    }
}
