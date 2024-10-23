<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CrmToken;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CheckCrmToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next (\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        $validator = Validator::make(['token' => $token], [
            'token' => 'required|string|max:64',
        ]);

        return
            !$validator->fails() && CrmToken::query()->where('token', $token)->exists()
                ? $next($request)
                : ApiResponse::error("Access denied", [], 403);

    }
}
