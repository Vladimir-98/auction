<?php

namespace App\Documentation;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/telegram/orders",
 *     tags={"Mini Apps"},
 *     summary="Получение карточек",
 *     @OA\Parameter(ref="#/components/parameters/X-Init-Data"),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="page", type="integer", example=2),
 *             @OA\Property(
 *                 property="filter",
 *                 type="object",
 *                 @OA\Property(property="categories", type="array", @OA\Items(type="integer"), example={1, 3}),
 *                 @OA\Property(property="districts", type="array", @OA\Items(type="integer"), example={2, 6}),
 *                 @OA\Property(property="paymentType", type="array", @OA\Items(type="integer"), example={3, 8}),
 *                 @OA\Property(
 *                     property="leadPrice",
 *                     type="object",
 *                     @OA\Property(property="min", type="integer", example=1000),
 *                     @OA\Property(property="max", type="integer", example=2000)
 *                 ),
 *                 @OA\Property(
 *                     property="budget",
 *                     type="object",
 *                     @OA\Property(property="min", type="integer", example=1000000),
 *                     @OA\Property(property="max", type="integer", example=4000000)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Получение карточек",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="orders", type="array",
 *                     @OA\Items(oneOf={@OA\Property(ref="#/components/schemas/Order")})
 *                 ),
 *                 @OA\Property(property="page", type="integer", example=1),
 *                 @OA\Property(property="hasMore", type="boolean", example=true)
 *             ),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Успех"),
 *             @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={})
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Ошибка получение карточек",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={}),
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="It's not a telegram || Не удалось получить карточки"),
 *             @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={})
 *         )
 *     )
 * )
 */
class IndexOrderControllerDoc
{
}


