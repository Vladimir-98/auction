<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\Telegram;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class VerifyTelegram
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        try {
            return
                !$request->hasHeader('X-Init-Data') || !Telegram::checkInitData($request)
                    ? ApiResponse::error("It's not a telegram", [])
                    : $next($request);

        } catch (JsonException $e) {
            Log::info('Middleware checkInitData: ' . $e->getMessage());
            return ApiResponse::error("It's not a telegram", []);
        }
    }
}
