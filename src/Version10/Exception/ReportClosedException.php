<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Exception;

use Phpcq\PluginApi\Version10\Report\TaskReportInterface;

class ReportClosedException extends RuntimeException
{
    /**
     * @var TaskReportInterface
     */
    private $toolReport;

    /**
     * Create a new instance.
     */
    public function __construct(TaskReportInterface $toolReport)
    {
        parent::__construct('Report has already been closed');

        $this->toolReport = $toolReport;
    }

    public function getToolReport(): TaskReportInterface
    {
        return $this->toolReport;
    }
}
