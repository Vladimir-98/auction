<?php

namespace App\Documentation\Commands;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/start",
 *     tags={"Telegram Bot"},
 *     summary="Команда /start",
 *     @OA\Response(
 *          response=200,
 *          description="Успешный ответ на команду /start",
 *          @OA\JsonContent(
 *              @OA\Property(property="chat_id", type="number", example=5334422),
 *              @OA\Property(property="text", type="string", example="🌟 Привет, мы рады видеть тебя в гостях! 🌟 🎉 Чтобы начать, просто нажми на кнопку: 👉 /auction 💳 Тест карта (max 1000): 1111 1111 1111 1026, 12/22, 000 💬 Если у тебя возникнут вопросы, не стесняйся обращаться!"),
 *              @OA\Property(property="parse_mode", type="string", example="html"),
 *         )
 *     )
 * )
 */
class StartCommandDoc
{
}
