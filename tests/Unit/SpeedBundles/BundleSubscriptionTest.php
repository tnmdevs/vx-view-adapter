<?php

namespace TNM\VXView\Tests\Unit\SpeedBundles;

use TNM\VXView\Services\SpeedBundles\BundleSubscription\BundleSubscriptionClient;
use TNM\VXView\Tests\TestCase;

class BundleSubscriptionTest extends TestCase
{
    public function test_buy_speed_bundle_successfully()
    {
        \Http::fake(['*' => \Http::response([
            'ResponseInfo' => ['Success' => true]
        ])]);

        $response = (new BundleSubscriptionClient('0888800900', 24312))->query();

        $this->assertTrue($response->successful());
    }
}
