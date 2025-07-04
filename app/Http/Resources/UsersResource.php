<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'posts'    => PostResource::collection($this->whenLoaded('posts')),
            'platforms'=> PlatformResource::collection($this->whenLoaded('platforms')),
        ];
    }
}