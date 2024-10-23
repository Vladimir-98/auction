<?php

namespace App\Documentation\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="FilterItems",
 *     type="array",
 *     @OA\Items(
 *         oneOf={
 *             @OA\Schema(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="categories"),
 *                 @OA\Property(property="title", type="string", example="Категории"),
 *                 @OA\Property(property="type", type="string", example="checkBox"),
 *                 @OA\Property(property="dropDown", type="boolean", example=true),
 *                 @OA\Property(property="active", type="boolean", example=false),
 *                 @OA\Property(
 *                     property="items",
 *                     type="array",
 *                     @OA\Items(ref="#/components/schemas/Category")
 *                 )
 *             ),
 *             @OA\Schema(
 *                 @OA\Property(property="id", type="integer", example=2),
 *                 @OA\Property(property="name", type="string", example="budget"),
 *                 @OA\Property(property="title", type="string", example="Бюджет"),
 *                 @OA\Property(property="type", type="string", example="rangeInput"),
 *                 @OA\Property(property="dropDown", type="boolean", example=true),
 *                 @OA\Property(property="active", type="boolean", example=false),
 *                 @OA\Property(
 *                     property="items",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="min", type="integer", nullable=true, example=null),
 *                         @OA\Property(property="max", type="integer", nullable=true, example=null),
 *                     )
 *                 )
 *             )
 *         }
 *     )
 * )
 */
class FilterItemsSchema
{
}
