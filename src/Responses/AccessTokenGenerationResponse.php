<?php

namespace TNM\VXView\Responses;

use Illuminate\Http\Client\Response;

class AccessTokenGenerationResponse
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getToken(): string
    {
        return $this->response->body();
    }

    public function notSuccessful(): bool
    {
        return !$this->successful();
    }

    private function successful(): bool
    {
        return $this->response->successful();
    }
}
