<?php

namespace App\Documentation;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Telegram Auction API",
 *     version="1.0.0",
 *     description="API для работы с Telegram Mini App"
 * )
 * @OA\Tag(
 *     name="Card",
 *     description="API для работы с карточками"
 * )
 * @OA\Tag(
 *     name="Mini Apps",
 *     description="Приложение в телеграм"
 * )
 * @OA\Tag(
 *     name="Telegram Bot",
 *     description="Команды Telegram бота"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 */
class OpenApi {}
