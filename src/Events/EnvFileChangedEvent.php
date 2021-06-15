<?php

namespace CodeBugLab\Env\Events;

use CodeBugLab\Env\Line;
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
