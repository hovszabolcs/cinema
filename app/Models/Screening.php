<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;
    /**
     * @OA\Schema(
     *     schema="Screening",
     *     type="object",
     *     title="Screening",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="start", type="string", example="2024-10-14 12:00:00"),
     *     @OA\Property(property="seats_available", type="integer", example=100),
     *     @OA\Property(property="url", type="string", example="https://example.com/screening"),
     *     @OA\Property(property="movie_id", type="integer", example=1),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-14 12:00:00"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-14 12:00:00")
     * )
     */

    /*
     * @property int $id
     * @property \Illuminate\Support\Carbon $start
     * @property int $seats_available
     * @property string $url
     * @property int $movie_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \App\Models\Movie $movie
     */

    protected $fillable = ['start', 'seats_available', 'url', 'movie_id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
