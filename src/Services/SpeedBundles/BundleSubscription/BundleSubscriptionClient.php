<?php

namespace TNM\VXView\Services\SpeedBundles\BundleSubscription;

class BundleSubscriptionClient
{
    private string $msisdn;
    private IBundleSubscriptionService $service;
    private int $bundleUid;

    public function __construct(string $msisdn, int $bundleUid)
    {
        $this->msisdn = msisdn($msisdn)->internationalize();
        $this->service = app(IBundleSubscriptionService::class);
        $this->bundleUid = $bundleUid;
    }

    public function query(): BundleSubscriptionResponse
    {
        return $this->service->query([
            'msisdn' => $this->msisdn,
            'bundle_uid' => $this->bundleUid
        ]);
    }
}
