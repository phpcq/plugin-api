<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10;

use Phpcq\PluginApi\Version10\Exception\Exception;
use Phpcq\PluginApi\Version10\Exception\ReportFileNotFoundException;
use PHPUnit\Framework\TestCase;

/** @covers \Phpcq\PluginApi\Version10\Exception\ReportFileNotFoundException */
final class ReportFileNotFoundExceptionTest extends TestCase
{
    public function testInstantiation(): void
    {
        $exception = new ReportFileNotFoundException('/path/to/file');

        self::assertInstanceOf(Exception::class, $exception);
        self::assertSame('/path/to/file', $exception->getFileName());
    }
}
