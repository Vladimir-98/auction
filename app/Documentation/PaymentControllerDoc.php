<?php

namespace App\Documentation;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/telegram/create-link-invoice",
 *     tags={"Mini Apps"},
 *     summary="Получение ссылки на оплату",
 *     @OA\Parameter(ref="#/components/parameters/X-Init-Data"),
 *     @OA\Response(
 *         response=200,
 *         description="Успешное получение ссылки на оплату",
 *         @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="invoiceLink", type="string", example="https://t.me/$kmtBZ9v2ADGSsCQAA_qReE3KW3KU"),
 *              ),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Успех"),
 *             @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={})
 *         )
 *     ),
 *     @OA\Response(
 *          response=400,
 *          description="Ошибка получения ссылки на оплату",
 *          @OA\JsonContent(
 *          type="object",
 *          @OA\Property(property="data", type="array", @OA\Items(type="string"), example={}),
 *          @OA\Property(property="success", type="boolean", example=false),
 *          @OA\Property(property="message", type="string", example="It's not a telegram || Не удалось создать ссылку"),
 *          @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={})
 *          )
 *     )
 * )
 */
class PaymentControllerDoc
{
}

