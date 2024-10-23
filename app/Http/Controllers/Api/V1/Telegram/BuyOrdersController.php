<?php

namespace App\Http\Controllers\Api\V1\Telegram;

use App\Models\Filter;
use App\Models\Client\Client;
use App\Services\CardService;
use OpenApi\Annotations as OA;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Http\Resources\CardResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilterResource;
use App\Http\Requests\TelegramUserDataRequest;

class BuyOrdersController extends Controller
{
    /**
     * @OA\Tag(name="Mini Apps")
     * @param TelegramUserDataRequest $request
     * @param CardService $cardService
     * @return JsonResponse
     */
    public function __invoke(TelegramUserDataRequest $request, CardService $cardService): JsonResponse
    {

        $clientData = $request->get('client');
        $cardIds = $request->get('cardIds', []);

        if (empty($clientData) || empty($cardIds)) {
            return ApiResponse::error('Данные отсутствуют!', 200);
        }

        if (!$client = Client::query()->firstWhere('telegram_id', '=', $clientData['telegram_id'])) {
            return ApiResponse::error('Клиент не найден!', 200);
        }

        $orders = $cardService->processBuyCards($cardIds, $client);
        $client = Client::query()->firstWhere('telegram_id', '=', $clientData['telegram_id']);

        return ApiResponse::success([
            'balance' => $client->balance,
            'orders' => CardResource::collection($orders),
            'filter' => FilterResource::collection(Filter::all())
        ]);
    }
}


