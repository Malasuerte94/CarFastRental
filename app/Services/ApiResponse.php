<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    /**
     * @param array $responseBody
     * @return JsonResponse
     */
    public static function json($data, string $message = null, $code = null): JsonResponse
    {
        return new JsonResponse([
            'message' => $message ?? '',
            'data' => $data ?? []
        ], $code ?? 200);
    }

    public static function jsonException(Exception $exception): JsonResponse
    {
        return self::json([
            'message' => $exception->getMessage(),
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR
        ]);
    }
}
