<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    /**
     * @OA\Get(
     *     path="/api/v1/users/{id}/posts",
     *     summary="Get user's posts",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function posts($id)
    {
        $posts = Post::where('user_id', $id)->with('user')->get();
        return PostResource::collection($posts);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/{id}/comments",
     *     summary="Get user's comments",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function comments($id)
    {
        $comments = Comment::where('user_id', $id)->with('post')->get();
        return CommentResource::collection($comments);
    }

}
