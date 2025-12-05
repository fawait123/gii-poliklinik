<?php

namespace App\Http\Data;

use Response;
use Spatie\LaravelData\Data;

class ResponseData extends Data
{
    public function __construct(
        public bool $success,
        public string $message,
        public mixed $data = null,
    ) {
    }

    /**
     * Summary of json
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function json(int $statusCode = \Symfony\Component\HttpFoundation\Response::HTTP_OK)
    {
        return response()->json($this->toArray(), $statusCode);
    }
}