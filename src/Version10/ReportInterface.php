<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface ReportInterface
{
    public const STATUS_STARTED = 'started';
    public const STATUS_PASSED  = 'passed';
    public const STATUS_FAILED  = 'failed';

    public function addToolReport(string $toolName): ToolReportInterface;
}
