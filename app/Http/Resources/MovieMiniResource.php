<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class MovieMiniResource extends MovieResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'description'       => mb_substr($this->description, 0, 100),
            'age_classification'=> $this->age_classification,
            'lang'              => $this->lang,
            'image_path'        => $this->image_path
        ];
    }
}
