<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiResponse
{
    protected bool $success;
    protected string $message;
    protected array $data;
    protected array|string $errors;

    /**
     * Response constructor.
     * @param bool $success
     * @param string $message
     * @param array $data
     * @param array $errors
     */
    public function __construct($success = true, $message = 'Успех', $data = [], $errors = '')
    {
        $this->data = $data;
        $this->errors = $errors;
        $this->success = $success;
        $this->message = $message;
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public static function success($data = [], $message = 'Успех', $status = 200): JsonResponse
    {
        $response = new self(true, $message, $data);
        return $response->toJson($status);
    }

    /**
     * @param string $message
     * @param array $errors
     * @param int $status
     * @return JsonResponse
     */
    public static function error($message = 'Ошибка', $errors = [], $status = 400): JsonResponse
    {
        $response = new self(false, $message, [], $errors);
        throw new HttpResponseException($response->toJson($status));
    }

    /**
     * @param int $status
     * @return JsonResponse
     */
    public function toJson($status = 200): JsonResponse
    {
        return response()->json([
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors,
        ], $status);
    }
}
