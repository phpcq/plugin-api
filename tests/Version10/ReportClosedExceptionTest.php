<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10;

use Phpcq\PluginApi\Version10\Exception\Exception;
use Phpcq\PluginApi\Version10\Exception\ReportClosedException;
use Phpcq\PluginApi\Version10\Report\TaskReportInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phpcq\PluginApi\Version10\Exception\ReportClosedException
 */
final class ReportClosedExceptionTest extends TestCase
{
    public function testInstantiation(): void
    {
        $report = $this->getMockForAbstractClass(TaskReportInterface::class);
        $exception = new ReportClosedException($report);

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertEquals($report, $exception->getToolReport());
    }
}
