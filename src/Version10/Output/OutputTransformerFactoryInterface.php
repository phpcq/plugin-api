<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Output;

use Phpcq\PluginApi\Version10\Report\ToolReportInterface;

interface OutputTransformerFactoryInterface
{
    public function createFor(ToolReportInterface $report): OutputTransformerInterface;
}
