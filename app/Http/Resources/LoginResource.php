<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class LoginResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserResource($this->getUser()),
            'token' => $this->getToken()->plainTextToken
        ];
    }
}
