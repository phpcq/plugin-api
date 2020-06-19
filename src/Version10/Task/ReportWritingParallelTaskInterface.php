<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;
use Phpcq\PluginApi\Version10\Report\ToolReportInterface;

/**
 * This interface describes a task that can be run in parallel to other tasks.
 */
interface ReportWritingParallelTaskInterface extends ReportWritingTaskInterface, ParallelTaskInterface
{
    /**
     * Run task with a report.
     *
     * In contradiction to the parent interface, the method MUST return immediately and
     * only perform long work within the tick method.
     *
     * @param ToolReportInterface $report The tool report being created.
     *
     * @throws RuntimeException When task initialization fails.
     */
    public function runWithReport(ToolReportInterface $report): void;
}
