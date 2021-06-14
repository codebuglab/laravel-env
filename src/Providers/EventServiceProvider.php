<?php

namespace CodeBugLab\Enver\Providers;

use CodeBugLab\Enver\Listeners\EnvFileChanged;
use CodeBugLab\Enver\Events\EnvFileChangedEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        EnvFileChangedEvent::class => [
            EnvFileChanged::class
        ],
    ];
}
