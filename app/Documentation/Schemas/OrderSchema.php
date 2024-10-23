<?php

namespace App\Documentation\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Order",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="1-ком. квартира"),
 *     @OA\Property(property="budget", type="string", example="12 000 000 - 15 000 000"),
 *     @OA\Property(property="leadPrice", type="integer", example=2000),
 *     @OA\Property(property="paymentType", type="string", example="Ипотека, Наличные"),
 *     @OA\Property(property="districts", type="string", example="Российский, Центральный"),
 *     @OA\Property(property="categories", type="boolean", example="Новостройка"),

 * )
 */
class OrderSchema
{
}
