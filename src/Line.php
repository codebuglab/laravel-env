<?php

namespace CodeBugLab\Enver;

use Illuminate\Support\Str;

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

    public function getFullLine()
    {
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
}
