<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10;

use Phpcq\PluginApi\Version10\Exception;
use Phpcq\PluginApi\Version10\RuntimeException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phpcq\PluginApi\Version10\RuntimeException
 */
final class RuntimeExceptionTest extends TestCase
{
    public function testInstantiation(): void
    {
        $exception = new RuntimeException();

        $this->assertInstanceOf(Exception::class, $exception);
    }
}
