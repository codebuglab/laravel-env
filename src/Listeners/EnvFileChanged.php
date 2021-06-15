<?php

namespace CodeBugLab\Env\Listeners;

use Illuminate\Support\Facades\Artisan;
use CodeBugLab\Env\Events\EnvFileChangedEvent;

class EnvFileChanged
{
    public function handle(EnvFileChangedEvent $event)
    {
        $line = $event->line;

        return Artisan::call('config:clear');
    }
}
