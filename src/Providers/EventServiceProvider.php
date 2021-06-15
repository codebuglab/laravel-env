<?php

namespace CodeBugLab\Env\Providers;

use CodeBugLab\Env\Listeners\EnvFileChanged;
use CodeBugLab\Env\Events\EnvFileChangedEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        EnvFileChangedEvent::class => [
            EnvFileChanged::class
        ],
    ];
}
