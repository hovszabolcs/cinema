<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ScreeningResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'start'             => $this->start,
            'seats_available'   => $this->seats_available,
            'url'               => $this->url,
            'movie'             => $this->movie->title,
            'created_at'        => $this->formatDate($this->created_at),
            'updated_at'        => $this->formatDate($this->updated_at)
        ];
    }
}
