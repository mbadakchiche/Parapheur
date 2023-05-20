<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AllPolicies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:allPolicies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This generates all policies for all modals that exists in App//Models folder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return generateAllPolicies();
    }
}
