<?php

namespace CodeBugLab\Enver;

use Illuminate\Support\Facades\Event;
use CodeBugLab\Enver\Events\EnvFileChangedEvent;

class Line
{
    protected $enver;
    protected $lineNumber;
    protected $fullLine;
    protected $key;
    protected $value;

    function __construct(Enver $enver)
    {
        $this->enver = $enver;
    }

    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    public function setLineNumber(int $lineNumber)
    {
        $this->lineNumber = $lineNumber;

        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey(string $key)
    {
        $this->key = $key;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get full line value
     *
     * @return string
     */
    public function getFullLine()
    {
        if (strlen($this->getKey()) > 0) {
            $this->setFullLine(
                sprintf('%s="%s"', $this->getKey(), $this->getValue())
            );
        }

        return $this->fullLine;
    }

    /**
     * Set full line form key and value
     *
     * @param string $fullLine
     * @return self
     */
    public function setFullLine(string $fullLine)
    {
        $this->fullLine = $fullLine;
        $exploded = explode("=", $fullLine);

        $value = $exploded[1];
        if (preg_match('/^(["\']).*\1$/m', $value)) {
            $value = substr($value, 1, -1);
        }

        return $this
            ->setKey($exploded[0])
            ->setValue($value);
    }

    /**
     * Creates a new line
     *
     * @return boolean
     */
    public function create()
    {
        $appended_position = file_put_contents(
            $this->enver->getPath(),
            $this->getFullLine() . "\n",
            FILE_APPEND | LOCK_EX
        );

        Event::dispatch(new EnvFileChangedEvent($this));

        return is_int($appended_position);
    }

    /**
     * Update a line
     *
     * @return boolean
     */
    public function update()
    {
        $replaced_position = file_put_contents(
            $this->enver->getPath(),
            preg_replace(
                sprintf("/%s.*\n/", $this->getKey()),
                $this->getFullLine() . "\n",
                file_get_contents($this->enver->getPath())
            )
        );

        Event::dispatch(new EnvFileChangedEvent($this));

        return is_int($replaced_position);
    }

    /**
     * Delete a line
     *
     * @return boolean
     */
    public function delete()
    {
        $deleted_position = file_put_contents(
            $this->enver->getPath(),
            preg_replace(
                sprintf("/%s.*\n/", $this->getKey()),
                "",
                file_get_contents($this->enver->getPath())
            )
        );

        Event::dispatch(new EnvFileChangedEvent($this));

        return is_int($deleted_position);
    }

    /**
     * Reset a value
     *
     * @return self
     */
    public function reset()
    {
        $this->setValue(null)->update();

        return $this;
    }
}
