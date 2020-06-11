<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Exception;

use Phpcq\PluginApi\Version10\Report\ToolReportInterface;

class ReportClosedException extends RuntimeException
{
    /**
     * @var ToolReportInterface
     */
    private $toolReport;

    /**
     * Create a new instance.
     */
    public function __construct(ToolReportInterface $toolReport)
    {
        parent::__construct('Report has already been closed');

        $this->toolReport = $toolReport;
    }

    public function getToolReport(): ToolReportInterface
    {
        return $this->toolReport;
    }
}
