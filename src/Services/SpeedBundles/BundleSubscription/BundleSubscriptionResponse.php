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

    public function successful(): bool
    {
        $responseData = $this->response->json();
        return $responseData['ResponseInfo']['Success'];
    }

    public function notSuccessful(): bool
    {
        return !$this->successful();
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
}
