<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Report;

interface ReportInterface
{
    public const STATUS_STARTED = 'started';
    public const STATUS_PASSED  = 'passed';
    public const STATUS_FAILED  = 'failed';

    /** @psalm-param array<string,string> $metadata */
    public function addTaskReport(string $taskName, array $metadata = []): TaskReportInterface;
}
