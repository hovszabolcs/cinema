<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

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
