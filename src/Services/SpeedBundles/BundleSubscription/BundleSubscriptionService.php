<?php

namespace TNM\VXView\Services\SpeedBundles\BundleSubscription;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use TNM\VXView\Models\AccessToken;
use TNM\VXView\Responses\BaseResponse;
use TNM\VXView\Services\UniqueIDGenerator;

class BundleSubscriptionService implements IBundleSubscriptionService
{
    public function query(array $attributes): BundleSubscriptionResponse
    {
        $accessToken = AccessToken::first();
        $logId = (new UniqueIDGenerator(18, 'SMA'))->generate();

        try {
            $response = Http::withHeaders([
                'Authorization' => sprintf('Bearer %s', $accessToken ? $accessToken->{'token'}: null)
            ])->post(sprintf('http://%s:%s/customerservices-services-web/V1/Services/ServiceName/%s',
                config('vx_view.hostname'), config('vx_view.port'), $attributes['msisdn']
            ), [
               'LogID' => $logId,
               'srvUID' => $attributes['bundle_uid']
            ]);
            return new BundleSubscriptionResponse($response);
        } catch (\Exception $exception) {
            \Log::error(sprintf('MSISDN: %s. %s', $attributes['msisdn'], $exception->getMessage()));

            return new BundleSubscriptionResponse(new Response(new BaseResponse(json_encode([
                'ResponseInfo' => [
                    'Message' => $exception->getMessage(),
                    'Success' => false,
                    'Code' => 'Exception'
                ]
            ]))));
        }
    }
}
