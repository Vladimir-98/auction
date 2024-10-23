<?php

namespace App\Http\Controllers\Api\V1\Telegram;

use App\Models\Filter;
use App\Models\Client\Client;
use OpenApi\Annotations as OA;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilterResource;
use App\Http\Resources\ClientResource;
use App\Http\Requests\TelegramUserDataRequest;

class InitController extends Controller
{
    /**
     * @OA\Tag(name="Mini Apps")
     * @param TelegramUserDataRequest $request
     * @return JsonResponse
     */
    public function __invoke(TelegramUserDataRequest $request): JsonResponse
    {
        $client = $request->get('client');

        $client = new ClientResource(
            Client::query()->firstOrCreate(['telegram_id' => $client['telegram_id']], $client)
        );

        return ApiResponse::success([
            'balance' => $client->balance,
            'filter' => FilterResource::collection(Filter::all())
        ]);
    }
}
