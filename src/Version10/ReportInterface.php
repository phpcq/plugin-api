<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface ReportInterface
{
    public const STATUS_STARTED = 'started';
    public const STATUS_PASSED  = 'passed';
    public const STATUS_FAILED  = 'failed';

    /**
     * Add a report for a specific tool.
     *
     * @param string   $status      Accepted values are eighter started, passed or failed.
     * @param string[] $attachments List of attached files as related path to the artifact directory.
     */
    public function addToolReport(
        string $toolName,
        string $status,
        string $output = null,
        array $attachments = []
    ) : void;

    public function addCheckstyle(string $fileName): CheckstyleFileInterface;
}
