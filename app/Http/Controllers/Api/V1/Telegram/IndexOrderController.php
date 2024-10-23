<?php

namespace App\Http\Controllers\Api\V1\Telegram;

use App\Models\Card\Card;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Http\Filters\CardFilter;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Http\Resources\CardResource;
use App\Http\Controllers\Controller;

class IndexOrderController extends Controller
{
    /**
     * @OA\Tag(name="Mini Apps")
     * @param Request $request
     * @param CardFilter $cardFilter
     * @return JsonResponse
     */
    public function __invoke(Request $request, CardFilter $cardFilter): JsonResponse
    {
        $cards = Card::filter($cardFilter)->paginate(3);

        return $request->has('filter')
            ? ApiResponse::success([
                'orders' => CardResource::collection($cards),
                'page' => $cards->currentPage(),
                'hasMore' => $cards->currentPage() !== $cards->lastPage(),
            ]) : ApiResponse::error('Не удалось получить карточки', 400);
    }
}


