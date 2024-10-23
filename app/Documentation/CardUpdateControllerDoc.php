<?php

namespace App\Documentation;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/card",
 *     tags={"Card"},
 *     description="Обновление || Создание карточки",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="crm_id", type="integer", example=12345),
 *             @OA\Property(property="crm_url", type="string", example="crm.com"),
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="desc", type="string", example="Описание проекта"),
 *             @OA\Property(property="phone", type="string", example="+71234567890"),
 *             @OA\Property(property="budget_min", type="integer", example=1000),
 *             @OA\Property(property="budget_max", type="integer", example=5000),
 *             @OA\Property(property="lead_price", type="integer", example=2000),
 *             @OA\Property(property="card_status", type="string", example="Ожидает"),
 *             @OA\Property(property="cities", type="array", @OA\Items(type="string"), example={"Москва"}),
 *             @OA\Property(property="districts", type="array", @OA\Items(type="string", maxLength=100), example={"district1", "district2"}),
 *             @OA\Property(property="types", type="array", @OA\Items(type="string", maxLength=100), example={"type1", "type2"}),
 *             @OA\Property(property="paymentTypes", type="array", @OA\Items(type="string", maxLength=100), example={"credit", "debit"}),
 *             @OA\Property(property="callRecords", type="array", @OA\Items(type="string", maxLength=255), example={"record1", "record2"})
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Успешный ответ на запрос",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Карточка обновлена!"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="crm_id", type="integer", example=1231),
 *                 @OA\Property(property="crm_url", type="string", example="crm.com"),
 *             ),
 *             @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={}),
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Доступ запрещён",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Access denied"),
 *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={}),
 *             @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={}),
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ошибка валидации",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Поле 'name' обязательно для заполнения."),
 *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={}),
 *             @OA\Property(
 *                  property="errors",
 *                  type="array",
 *                  @OA\Items(type="string"),
 *                  example={"name": {"Поле 'name' обязательно для заполнения."}})
 *         )
 *     )
 * )
 */
class CardUpdateControllerDoc
{
}


