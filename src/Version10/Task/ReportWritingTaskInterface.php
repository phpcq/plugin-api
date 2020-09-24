<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;
use Phpcq\PluginApi\Version10\Report\TaskReportInterface;

interface ReportWritingTaskInterface extends TaskInterface
{
    /**
     * Run task with a report.
     *
     * @param TaskReportInterface $report The tool report being created.
     *
     * @throws RuntimeException When task fails.
     */
    public function runWithReport(TaskReportInterface $report): void;
}
