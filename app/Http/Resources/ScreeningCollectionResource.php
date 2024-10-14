<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ScreeningCollectionResource extends BaseResourceCollection
{
    public function toArray(Request $request): array
    {
        return ['screenings' => ScreeningResource::collection($this)];
    }
}
