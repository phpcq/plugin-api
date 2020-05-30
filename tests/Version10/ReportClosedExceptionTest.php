<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10;

use Phpcq\PluginApi\Version10\Exception;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phpcq\PluginApi\Version10\ReportClosedException
 */
final class ReportClosedException extends TestCase
{
    public function testInstantiation(): void
    {
        $exception = new ReportClosedException();

        $this->assertInstanceOf(Exception::class, $exception);
    }
}
