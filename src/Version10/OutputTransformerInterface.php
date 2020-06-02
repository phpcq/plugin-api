<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

/**
 * This interface handles output transformations of tasks.
 *
 * The workflow is as follows:
 * 1. The transformer is attached to a report via a call to "attach".
 * 2. All subsequent calls to "write" shall transform the passed data into errors for the passed report.
 * 3. Transformation is finished with a call to "detach".
 */
interface OutputTransformerInterface
{
    /**
     * Opens the transformer for the given report.
     *
     * @param ToolReportInterface $report The report all further writes shall go to.
     */
    public function attach(ToolReportInterface $report): void;

    /**
     * Process the passed data and generate errors in the attached report.
     *
     * @param string $data    The data to buffer.
     * @param int    $channel The channel the data was received on (see OutputInterface::CHANNEL_*).
     */
    public function write(string $data, int $channel): void;

    /**
     * Get's called to detach the transformer from the report.
     *
     * The implementing instance should close all file handles and free memory.
     * After this is called, no further call to write will occur or is allowed until attached to another report.
     *
     * @param int $exitCode The exit code of the task.
     */
    public function detach(int $exitCode): void;
}
