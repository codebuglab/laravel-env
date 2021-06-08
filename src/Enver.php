<?php

namespace CodeBugLab\Enver;

use Illuminate\Support\Env;

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
     * @return int
     */
    public function locate(string $key)
    {
        return $this->createNewLine(
            array_filter(
                preg_split("/\n/", $this->getEnvContent()),
                function ($line) use ($key) {
                    preg_match(sprintf("/^%s/m", $key), $line, $key_exist);

                    return is_array($key_exist) && count($key_exist) > 0;
                }
            )
        );
    }

    public function append($key, $default = null)
    {
        return true;
    }

    private function createNewLine(array $matched_line)
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
