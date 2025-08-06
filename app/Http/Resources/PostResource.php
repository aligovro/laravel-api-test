<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PostResource",
 *     title="Post Resource",
 *     description="Модель поста",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=3),
 *     @OA\Property(property="body", type="string", example="Текст поста"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-06T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-06T12:00:00Z"),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource")
 * )
 */

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'body' => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
