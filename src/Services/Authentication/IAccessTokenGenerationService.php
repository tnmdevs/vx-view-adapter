<?php

namespace TNM\VXView\Services\Authentication;

use TNM\VXView\Responses\AccessTokenGenerationResponse;

interface IAccessTokenGenerationService
{
    public function query(): AccessTokenGenerationResponse;
}
