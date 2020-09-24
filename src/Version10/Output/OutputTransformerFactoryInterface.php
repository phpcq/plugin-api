<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Output;

use Phpcq\PluginApi\Version10\Report\TaskReportInterface;

/**
 * This interface describes a factory which creates an instance of an output transformer which transform the raw
 * tool output into the report.
 */
interface OutputTransformerFactoryInterface
{
    public function createFor(TaskReportInterface $report): OutputTransformerInterface;
}
