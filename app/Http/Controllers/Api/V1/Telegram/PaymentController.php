<?php

namespace App\Http\Controllers\Api\V1\Telegram;

use App\Facades\Telegram;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * @OA\Tag(name="Mini Apps")
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(
        Request $request
    ): JsonResponse
    {

        if (0 >= $sum = $request->get('sum')) {
            return ApiResponse::error('Некорректная сумма', [], 200);
        }

        $title = 'Пополнение';
        $desc = 'Вы пополняете баланс на сумму - ' . $sum;
        $payload = config('services.telegram.provider_name');
        $currency = 'RUB';
        $prices = [['label' => 'сумма', 'amount' => (string)($sum * 100)]];

        $response = Telegram::createInvoiceLink(
            $title,
            $desc,
            $payload,
            $currency,
            $prices,
        )->send();

        return $response['ok']
            ? ApiResponse::success(['invoiceLink' => $response['result']])
            : ApiResponse::error('Не удалось создать ссылку', 400);
    }
}


