<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'genre' => $this->genre,
            'duration_minutes' => $this->duration_minutes,
            'release_year' => $this->release_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'users' => UserResource::collection(
                $this->whenLoaded('users')
            ),
        ];
    }
}
