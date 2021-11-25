<?php

namespace TNM\VXView\Services\Authentication;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use TNM\VXView\Responses\AccessTokenGenerationResponse;
use TNM\VXView\Responses\BaseResponse;

class AccessTokenGenerationService implements IAccessTokenGenerationService
{

    public function query(): AccessTokenGenerationResponse
    {
        $requestUrl = sprintf(
            'http://%s:%s@%s:%s/AuthenticationServices/V1/Authentication/Authenticate/1',
            config('vx_view.auth.username'),
            config('vx_view.auth.password'),
            config('vx_view.auth.hostname'),
            config('vx_view.auth.port')
        );

        try {
            $response = Http::post($requestUrl);

            return new AccessTokenGenerationResponse($response);

        } catch (\Exception $exception) {
            Log::error('Failed to renew VX-View token');
            return new AccessTokenGenerationResponse(new Response(new BaseResponse([], 500)));
        }
    }
}
