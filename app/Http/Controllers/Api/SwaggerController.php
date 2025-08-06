<?php

namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *     title="ProFashion API",
 *     version="1.0",
 *     description="Документация для REST API",
 *     @OA\Contact(
 *         email="support@profashion.com"
 *     )
 * )
 *
 * @OA\Schema(
 * schema="StoreCommentRequest",
 * required={"user_id", "post_id", "body"},
 * @OA\Property(property="user_id", type="integer", example=1),
 * @OA\Property(property="post_id", type="integer", example=1),
 * @OA\Property(property="body", type="string", example="Комментарий")
 * )
 *
 * @OA\Schema(
 * schema="StorePostRequest",
 * required={"user_id", "body"},
 * @OA\Property(property="user_id", type="integer", example=1),
 * @OA\Property(property="body", type="string", example="Пост")
 * )
 *
 * @OA\Schema(
 * schema="UpdatePostRequest",
 * required={"body"},
 * @OA\Property(property="body", type="string", example="Обновлённый пост")
 * )
 *
 * @OA\Schema(
 * schema="UpdateCommentRequest",
 * required={"body"},
 * @OA\Property(property="body", type="string", example="Обновлённый комментарий")
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Основной сервер"
 * )
 */
class SwaggerController
{
    //
}
