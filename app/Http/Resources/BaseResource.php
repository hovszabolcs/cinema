<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BaseResource extends JsonResource
{
    public function with(Request $request): array
    {
        return [
            'type'      => 'response',
            'success'   => true
        ];
    }

    protected function formatDate(Carbon $date): string {
        return $date->format('Y-m-d H:i:s');
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json(array_merge(
            $this->with($request),
            $this->resolve($request)
        ));
    }
}
