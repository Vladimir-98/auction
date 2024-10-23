<?php

namespace App\Documentation\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Category",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Новостройки"),
 *     @OA\Property(property="img", type="string", example="/upload/svg/novostroyki.svg"),
 *     @OA\Property(property="total", type="integer", example=20),
 *     @OA\Property(property="active", type="boolean", example=false)
 * )
 */
class CategorySchema {}
