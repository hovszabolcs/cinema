<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * @OA\Schema(
     *     schema="Movie",
     *     type="object",
     *     title="Movie",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="title", type="string", example="The Movie Title"),
     *     @OA\Property(property="description", type="string", example="This is a description of the movie."),
     *     @OA\Property(property="age_classification", type="integer", example=16, description="Age classification for movies (12,16,18)"),
     *     @OA\Property(property="lang", type="string", example="en", description="Language of the movie"),
     *     @OA\Property(property="image_path", type="string", format="url", example="https://example.com/movie.jpg", description="URL path of movie image"),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-14 12:00:00", description="Creation timestamp"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-14 12:00:00", description="Last update timestamp")
     * )
     */

    /*
     * @property int $id
     * @property string $title
     * @property string $description
     * @property int $age_classification
     * @property string $lang
     * @property string $image_path
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Screening[] $screenings
     */
    protected $fillable = ['title', 'description', 'age_classification', 'lang', 'image_path'];

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}
