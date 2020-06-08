<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\PluginApi\Version10\RuntimeException;
use Phpcq\PluginApi\Version10\ToolReportInterface;

interface ReportWritingTaskRunnerInterface extends TaskInterface
{
    /**
     * Run task with a report.
     *
     * @param ToolReportInterface $report The tool report being created.
     *
     * @throws RuntimeException When task fails.
     */
    public function runWithReport(ToolReportInterface $report): void;
}
