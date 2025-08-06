<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/users/{id}/posts",
     *     summary="Get user's posts",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PostResource"))
     *     )
     * )
     */
    public function posts(User $user)
    {
        $posts = $user->posts()->with('user')->get();
        return PostResource::collection($posts);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/{id}/comments",
     *     summary="Get user's comments",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CommentResource"))
     *     )
     * )
     */
    public function comments(User $user)
    {
        $comments = $user->comments()->with('post')->get();
        return CommentResource::collection($comments);
    }
}
