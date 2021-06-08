<?php

namespace CodeBugLab\Enver\Tests\Unit;

use CodeBugLab\Enver\Exceptions\KeyAlreadyExistsException;
use CodeBugLab\Enver\Line;
use CodeBugLab\Enver\Facades\Enver;
use CodeBugLab\Enver\Tests\TestCase;

class EnverTest extends TestCase
{
    public function test_it_reads_a_value_from_env_file()
    {
        $app_key = Enver::get("APP_KEY");

        $this->assertEquals($app_key, "base64:2fl+Ktvkfl+Fuz4Qp/A75G2RTiWVA/ZoKZvp6fiiM10=");
    }

    public function test_it_gets_null_for_line_number_if_key_not_found()
    {
        $line = Enver::locate("KEY_NOT_EXISTS");

        $this->assertNull($line);
    }

    public function test_it_gets_line_number_when_key_passed()
    {
        $line = Enver::locate("DB_CONNECTION");

        $this->assertInstanceOf(Line::class, $line);
        $this->assertEquals(1, $line->getLineNumber());
        $this->assertEquals('DB_CONNECTION', $line->getKey());
    }

    public function test_it_throws_an_exception_if_appended_key_exists()
    {
        $this->expectException(KeyAlreadyExistsException::class);

        Enver::append("DB_CONNECTION", time());
    }

    public function test_it_returns_success_if_append_key_is_done()
    {
        // manual delete test value first
        file_put_contents(
            app()->environmentFilePath(),
            preg_replace(
                sprintf("/^FOO=\"%s\"\n/m", env('FOO')),
                "",
                file_get_contents(app()->environmentFilePath())
            )
        );

        $append = Enver::append("FOO", time());

        $this->assertTrue($append);
    }
}
