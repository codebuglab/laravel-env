<?php

namespace CodeBugLab\LaravelEnv\Events;

use CodeBugLab\LaravelEnv\Line;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class EnvFileChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $line;

    public function __construct(Line $line)
    {
        $this->line = $line;
    }
}
