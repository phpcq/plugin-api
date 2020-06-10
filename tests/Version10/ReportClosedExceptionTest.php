<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10;

use Phpcq\PluginApi\Version10\Exception\Exception;
use Phpcq\PluginApi\Version10\Exception\ReportClosedException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phpcq\PluginApi\Version10\Exception\ReportClosedException
 */
final class ReportClosedExceptionTest extends TestCase
{
    public function testInstantiation(): void
    {
        $exception = new ReportClosedException();

        $this->assertInstanceOf(Exception::class, $exception);
    }
}
