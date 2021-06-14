<?php

namespace CodeBugLab\Enver\Listeners;

use Illuminate\Support\Facades\Artisan;
use CodeBugLab\Enver\Events\EnvFileChangedEvent;

class EnvFileChanged
{
    public function handle(EnvFileChangedEvent $event)
    {
        $line = $event->line;

        return Artisan::call('config:clear');
    }
}
