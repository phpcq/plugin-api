<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10;

use Phpcq\PluginApi\Version10\Exception\Exception;
use Phpcq\PluginApi\Version10\Exception\InvalidConfigException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phpcq\PluginApi\Version10\Exception\InvalidConfigException
 */
final class InvalidConfigExceptionTest extends TestCase
{
    public function testInstantiation(): void
    {
        $exception = new InvalidConfigException();

        $this->assertInstanceOf(Exception::class, $exception);
    }
}
