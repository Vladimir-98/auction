<?php

namespace App\Http\Controllers\Api\V1\Card;

use App\Services\CardService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CardRequest;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

class UpdateController extends Controller
{
    /**
     * @OA\Tag(name="Card")
     * @param CardRequest $cardRequest
     * @param CardService $cardService
     * @return JsonResponse
     */
    public function __invoke(CardRequest $cardRequest, CardService $cardService): JsonResponse
    {

        $card = $cardService->create($cardRequest);

        return
            $card
                ? ApiResponse::success(['crm_id' => $card->crm_id, 'crm_url' => $card->crm_url], 'Карточка обновлена!')
                : ApiResponse::error('Не удалось обновить карточку!', []);
    }
}
