<?php

namespace CodeBugLab\Enver;

use Illuminate\Support\Env;
use CodeBugLab\Enver\Facades\EnverLine;
use CodeBugLab\Enver\Exceptions\KeyNotFoundException;
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
    public function locate(string $key, bool $forceUpdate = false)
    {
        return $this->createNewLineObject(
            array_filter(
                preg_split("/\n/", $this->getEnvContent($forceUpdate)),
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
        $line = $this->locate($key, true);

        if ($line instanceof Line) {
            throw new KeyAlreadyExistsException;
        }

        return EnverLine::setKey($key)
            ->setValue($value)
            ->create();
    }

    /**
     * Replace key with given value
     *
     * @param string $key
     * @param mixed $value
     * @return boolean
     */
    public function replace(string $key, $value)
    {
        $line = $this->locate($key, true);

        if (!$line instanceof Line) {
            throw new KeyNotFoundException;
        }

        return $line->setValue($value)->update();
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
            ->setLineNumber($key + 1)
            ->setFullLine(current($matched_line));
    }
}
