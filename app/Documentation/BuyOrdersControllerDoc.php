<?php

namespace App\Documentation;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/telegram/buy-orders",
 *     tags={"Mini Apps"},
 *     summary="Оплата карточек",
 *     @OA\Parameter(ref="#/components/parameters/X-Init-Data"),
 *     @OA\Response(
 *         response=200,
 *         description="Успешная оплата карточек",
 *         @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="balance", type="number", example=10000),
 *                  @OA\Property(property="orders", type="array", @OA\Items(type="integer"), example={45, 233}),
 *                  @OA\Property(property="filter", ref="#/components/schemas/FilterItems"),
 *              ),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Успех"),
 *             @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={})
 *         )
 *     ),
 *     @OA\Response(
 *          response=400,
 *          description="Ошибка оплаты карточек",
 *          @OA\JsonContent(
 *          type="object",
 *          @OA\Property(property="data", type="array", @OA\Items(type="string"), example={}),
 *          @OA\Property(property="success", type="boolean", example=false),
 *          @OA\Property(property="message", type="string", example="It's not a telegram || Данные отсутствуют! || Клиент не найден!"),
 *          @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={})
 *          )
 *     )
 * )
 */
class BuyOrdersControllerDoc
{
}

