<?php

namespace CodeBugLab\LaravelEnv\Listeners;

use Illuminate\Support\Facades\Artisan;
use CodeBugLab\LaravelEnv\Events\EnvFileChangedEvent;

class EnvFileChanged
{
    public function handle(EnvFileChangedEvent $event)
    {
        $line = $event->line;

        return Artisan::call('config:clear');
    }
}
