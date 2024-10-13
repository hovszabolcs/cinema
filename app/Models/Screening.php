<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;
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
