<?php

namespace App\Documentation\Parameters;

use OpenApi\Annotations as OA;

/**
 * @OA\Parameter(
 *     parameter="X-Init-Data",
 *     name="X-Init-Data",
 *     in="header",
 *     required=true,
 *     description="Telegram.WebApp.initData",
 *     @OA\Schema(type="string")
 * )
 */
class XInitDataHeader
{
}
