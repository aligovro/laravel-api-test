<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments', CommentController::class);

    Route::get('/users/{id}/posts', [UserController::class, 'posts']);
    Route::get('/users/{id}/comments', [UserController::class, 'comments']);
    Route::get('/posts/{id}/comments', [PostController::class, 'comments']);
});
