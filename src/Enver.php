<?php

namespace CodeBugLab\Enver;

use Illuminate\Support\Env;
use CodeBugLab\Enver\Facades\EnverLine;
use CodeBugLab\Enver\Exceptions\KeyAlreadyExistsException;

class Enver extends Env
{
    protected $envContent;

    function __construct()
    {
        //
    }

    /**
     * Get .env file path
     *
     * @return string
     */
    public static function getPath()
    {
        return app()->environmentFilePath();
    }

    /**
     * Set .env file content
     *
     * @return string
     */
    private function setEnvContent()
    {
        $this->envContent = file_get_contents(self::getPath());

        return $this;
    }

    /**
     * Get .env file content
     *
     * @return string
     */
    public function getEnvContent(bool $forceUpdate = false)
    {
        if (!$this->envContent || $forceUpdate === true) {
            $this->setEnvContent();
        }

        return $this->envContent;
    }

    /**
     * Get line number for passed key
     *
     * @param string $key
     * @return Line|null
     */
    public function locate(string $key)
    {
        return $this->createNewLineObject(
            array_filter(
                preg_split("/\n/", $this->getEnvContent()),
                function ($line) use ($key) {
                    preg_match(sprintf("/^%s/m", $key), $line, $key_exist);

                    return is_array($key_exist) && count($key_exist) > 0;
                }
            )
        );
    }

    /**
     * Append new line to .env file
     *
     * @param string $key
     * @param mixed $value
     * @return boolean
     * @throws KeyAlreadyExistsException
     */
    public function append(string $key, $value)
    {
        $line = $this->locate($key);

        if (!is_null($line)) {
            throw new KeyAlreadyExistsException("Key already exists", 1);
        }

        return EnverLine::setKey($key)
            ->setValue($value)
            ->create();
    }

    /**
     * Create new Line object
     *
     * @param array $matched_line
     * @return Line|null
     */
    private function createNewLineObject(array $matched_line)
    {
        $key = key($matched_line);

        if (is_null($key)) {
            return;
        }

        return (new Line($this))
            ->setLineNumber($key)
            ->setFullLine(current($matched_line));
    }
}
