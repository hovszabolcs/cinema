<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class LoginResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        // store 201 delete 204
        return [
            'user' => new UserResource($this->getUser()),
            'token' => $this->getToken()->plainTextToken
        ];
    }
}
