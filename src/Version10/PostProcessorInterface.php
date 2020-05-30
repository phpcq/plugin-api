<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

/**
 * Interface PostProcessorInterface describes an post processor which handles a task output.
 *
 * It creates the report information for the ran task.
 */
interface PostProcessorInterface
{
    public function process(
        ToolReportInterface $report,
        string $consoleOutput,
        int $exitCode,
        OutputInterface $output
    ) : void;
}
