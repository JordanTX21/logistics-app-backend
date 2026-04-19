<?php

namespace Src\Shared\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a standardized success JSON response.
     */
    protected function success(mixed $data = null, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            ...($data !== null ? ['data' => $data] : []),
        ], $statusCode);
    }

    /**
     * Return a standardized error JSON response.
     */
    protected function error(string $message, mixed $data = null, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            ...($data !== null ? ['data' => $data] : []),
        ], $statusCode);
    }
}
