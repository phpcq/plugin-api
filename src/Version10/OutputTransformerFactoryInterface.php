<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface OutputTransformerFactoryInterface
{
    public function createFor(ToolReportInterface $report): OutputTransformerInterface;
}
