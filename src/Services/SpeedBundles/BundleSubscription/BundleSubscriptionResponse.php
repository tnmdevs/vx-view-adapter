<?php

namespace TNM\VXView\Services\SpeedBundles\BundleSubscription;

use Illuminate\Http\Client\Response;

class BundleSubscriptionResponse
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function success(): bool
    {
        $responseData = $this->response->json();
        return $responseData['ResponseInfo']['Success'];
    }

    public function notSuccessful(): bool
    {
        return !$this->success();
    }

    public function getMessage()
    {
        $responseData = $this->response->json();
        return $responseData['ResponseInfo']['Message'];
    }

    public function isException(): bool
    {
        $responseData = $this->response->json();
        return $responseData['ResponseInfo']['Code'] == 'Exception';
    }

    public function isInsufficientBalanceError(): bool
    {
        return false;
    }
}
