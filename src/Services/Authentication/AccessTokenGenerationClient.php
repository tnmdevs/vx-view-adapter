<?php

namespace TNM\VXView\Services\Authentication;

use TNM\VXView\Models\AccessToken;

class AccessTokenGenerationClient
{
    private IAccessTokenGenerationService $service;

    public function __construct()
    {
        $this->service = app(IAccessTokenGenerationService::class);
    }

    public function query(): void
    {
        $response = $this->service->query();

        if ($response->notSuccessful()) return;

        AccessToken::updateOrCreate([], ['token' => $response->getToken()]);
    }
}
