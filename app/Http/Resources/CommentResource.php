<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="CommentResource",
 *     title="Comment Resource",
 *     description="Комментарий к посту",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="post_id", type="integer", example=5),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="body", type="string", example="Это комментарий"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-06T14:22:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-06T14:23:00Z")
 * )
 */

class CommentResource extends JsonResource
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
            'post_id' => $this->post_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'body' => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
