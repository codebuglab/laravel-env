<?php

namespace CodeBugLab\LaravelEnv\Providers;

use CodeBugLab\LaravelEnv\Listeners\EnvFileChanged;
use CodeBugLab\LaravelEnv\Events\EnvFileChangedEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        EnvFileChangedEvent::class => [
            EnvFileChanged::class
        ],
    ];
}
