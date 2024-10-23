<?php

namespace App\Documentation\Commands;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/auction",
 *     tags={"Telegram Bot"},
 *     summary="Команда /auction",
 *     description="Вывод кнопки для запуска mini apps",
 *     @OA\Response(
 *          response=200,
 *          description="Успешный ответ на команду /auction",
 *          @OA\JsonContent(
 *              @OA\Property(property="chat_id", type="number", example=5334422),
 *              @OA\Property(property="text", type="string", example="Открыть каталог в приложении"),
 *              @OA\Property(property="parse_mode", type="string", example="html"),
 *              @OA\Property(
 *                  property="inline_keyboard",
 *                  type="array",
 *                  @OA\Items(
 *                      type="array",
 *                      @OA\Items(
 *                          @OA\Property(property="text", type="string", example="Вперед"),
 *                          @OA\Property(
 *                              property="web_app",
 *                              type="object",
 *                              @OA\Property(property="url", type="string", example="/telegram/auction")
 *                          )
 *                      )
 *                  )
 *              )
 *          )
 *      )
 * )
 */
class AuctionCommandDoc
{
}
