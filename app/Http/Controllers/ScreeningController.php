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
    public function index(): ScreeningCollectionResource
    {
        return new ScreeningCollectionResource($this->screeningService->getAll());
    }

    /**
     * Store a newly created resource in storage.
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
    public function show(Screening $screening): ScreeningResource
    {
        return new ScreeningResource($screening);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreScreeningRequest $request, Screening $screening): ScreeningResource
    {
        return new ScreeningResource($this->screeningService->update($request->all(), $screening));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Screening $screening)
    {
        $screening->delete();
        return response()->json(null, 204);
    }
}
