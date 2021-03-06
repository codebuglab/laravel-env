<?php

namespace CodeBugLab\Env\Tests\Unit;

use CodeBugLab\Env\Line;
use CodeBugLab\Env\Facades\Env;
use CodeBugLab\Env\Tests\TestCase;
use Illuminate\Support\Facades\Event;
use CodeBugLab\Env\Events\EnvFileChangedEvent;
use CodeBugLab\Env\Exceptions\KeyNotFoundException;
use CodeBugLab\Env\Exceptions\KeyAlreadyExistsException;

class EnvTest extends TestCase
{
    private function deleteFooKey()
    {
        file_put_contents(
            app()->environmentFilePath(),
            preg_replace(
                "/FOO.*\n/",
                "",
                file_get_contents(app()->environmentFilePath())
            )
        );
    }

    public function test_it_reads_a_value_from_env_file()
    {
        $app_key = Env::get("APP_KEY");

        $this->assertEquals($app_key, "base64:2fl+Ktvkfl+Fuz4Qp/A75G2RTiWVA/ZoKZvp6fiiM10=");
    }

    public function test_it_gets_null_for_line_number_if_key_not_found()
    {
        $line = Env::locate("KEY_NOT_EXISTS");

        $this->assertNull($line);
    }

    public function test_it_gets_line_number_when_key_passed()
    {
        $line = Env::locate("DB_CONNECTION");

        $this->assertInstanceOf(Line::class, $line);
        $this->assertEquals(2, $line->getLineNumber());
        $this->assertEquals('DB_CONNECTION', $line->getKey());
    }

    public function test_it_throws_an_exception_if_appended_key_exists()
    {
        $this->expectException(KeyAlreadyExistsException::class);

        Env::append("DB_CONNECTION", time());
    }

    public function test_it_returns_success_if_append_key_is_done()
    {
        $this->deleteFooKey();

        Event::fake();

        $append = Env::append("FOO", time());

        $this->assertTrue($append);
        Event::assertDispatched(EnvFileChangedEvent::class);

        $this->deleteFooKey();
    }

    public function test_it_throws_key_not_found_exception_when_replacing()
    {
        $this->expectException(KeyNotFoundException::class);

        Env::replace("KEY_NOT_EXISTS", time());
    }

    public function test_it_replaces_given_text()
    {
        Event::fake();
        $replaced = Env::replace("DB_CONNECTION", time());

        $this->assertTrue($replaced);
        Event::assertDispatched(EnvFileChangedEvent::class);
    }

    public function test_it_deletes_a_key()
    {
        $this->deleteFooKey();

        Event::fake();
        Env::append("FOO", time());

        $deleted = Env::delete("FOO");

        $this->assertTrue($deleted);
        Event::assertDispatched(EnvFileChangedEvent::class);
    }

    public function test_it_resets_a_value_for_a_line()
    {
        $this->deleteFooKey();
        Env::append("FOO", time());

        Env::reset("FOO");

        $this->assertEmpty(Env::get("FOO"));

        $this->deleteFooKey();
    }
}
