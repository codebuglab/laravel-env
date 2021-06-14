<?php

namespace CodeBugLab\Enver;

use Illuminate\Support\Facades\Artisan;

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

    public function getFullLine()
    {
        if (strlen($this->getKey()) > 0) {
            $this->setFullLine(
                sprintf('%s="%s"', $this->getKey(), $this->getValue())
            );
        }

        return $this->fullLine;
    }

    public function setFullLine(string $fullLine)
    {
        $this->fullLine = $fullLine;

        return $this
            ->setKey(explode("=", $fullLine)[0])
            ->setValue(
                $this->enver->get(
                    $this->getKey()
                )
            );
    }

    public function create()
    {
        $appended_position = file_put_contents(
            $this->enver->getPath(),
            $this->getFullLine() . "\n",
            FILE_APPEND | LOCK_EX
        );

        Artisan::call('config:clear');

        return is_int($appended_position);
    }

    public function update()
    {
        $replaced_position = file_put_contents(
            $this->enver->getPath(),
            preg_replace(
                sprintf("/%s.*/", $this->getKey()),
                $this->getFullLine(),
                file_get_contents($this->enver->getPath())
            )
        );

        Artisan::call('config:clear');

        return is_int($replaced_position);
    }
}
