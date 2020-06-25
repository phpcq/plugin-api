<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;
use Phpcq\PluginApi\Version10\Report\ToolReportInterface;

interface ReportWritingTaskInterface extends TaskInterface
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
