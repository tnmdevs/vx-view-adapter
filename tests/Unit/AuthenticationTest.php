<?php

namespace TNM\VXView\Tests\Unit;

use TNM\VXView\Models\AccessToken;
use TNM\VXView\Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_generate_access_token()
    {
        \Http::fake(['*' => \Http::response('some-random-token')]);

        $this->artisan('vx-view:generate-access-token')->assertExitCode(0)->run();

        $this->assertDatabaseHas(AccessToken::class, ['token' => 'some-random-token']);
        $this->assertDatabaseCount(AccessToken::class, 1);
    }


}
