<?php

namespace TNM\VXView\Services\SpeedBundles\BundleSubscription;

interface IBundleSubscriptionService
{
    public function query(array $attributes): BundleSubscriptionResponse;
}
