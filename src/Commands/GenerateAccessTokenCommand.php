<?php

namespace TNM\VXView\Commands;

use Illuminate\Console\Command;
use TNM\VXView\Services\Authentication\AccessTokenGenerationClient;

class GenerateAccessTokenCommand extends Command
{
    protected $signature = 'vx-view:generate-access-token';

    protected $description = 'Generate access token';

    public function handle(): int
    {
        (new AccessTokenGenerationClient())->query();
        $this->info('Finished command');
        return 0;
    }
}
