<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/comments",
     *     summary="Get all comments",
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index()
    {
        return CommentResource::collection(Comment::with('user', 'post')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/comments",
     *     summary="Create a comment",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCommentRequest")
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->validated());
        return new CommentResource($comment);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/comments/{id}",
     *     summary="Get a comment",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment->load('user', 'post'));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/comments/{id}",
     *     summary="Update a comment",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCommentRequest")
     *     ),
     *     @OA\Response(response=200, description="Updated")
     * )
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return new CommentResource($comment);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/comments/{id}",
     *     summary="Delete a comment",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();
    }
}
