<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Report\AttachmentBuilderInterface;
use Phpcq\PluginApi\Version10\Report\DiagnosticBuilderInterface;
use Phpcq\PluginApi\Version10\Report\DiffBuilderInterface;

interface ToolReportInterface
{
    public const STATUS_STARTED = ReportInterface::STATUS_STARTED;
    public const STATUS_PASSED  = ReportInterface::STATUS_PASSED;
    public const STATUS_FAILED  = ReportInterface::STATUS_FAILED;
    public const STATUS_SKIPPED = 'skipped';

    /**
     * An non issue - strictly informational.
     */
    public const SEVERITY_INFO  = 'info';

    /**
     * Normal but significant diagnostic - no action has to be taken.
     */
    public const SEVERITY_NOTICE  = 'notice';

    /**
     * An issue that should be fixed.
     */
    public const SEVERITY_WARNING = 'warning';

    /**
     * An issue that MUST be fixed.
     */
    public const SEVERITY_ERROR = 'error';

    /**
     * Build a diagnostic entry.
     *
     * @param string $severity The severity of the error - one of the self::SEVERITY_* constants.
     * @param string $message  The error message.
     *
     * @return DiagnosticBuilderInterface
     *
     * @throws RuntimeException When the passed severity is invalid.
     * @throws ReportClosedException When report is closed.
     */
    public function addDiagnostic(string $severity, string $message): DiagnosticBuilderInterface;

    /**
     * Build an attachment entry.
     *
     * @param string $name The internal name of the attachment.
     *
     * @return AttachmentBuilderInterface
     *
     * @throws ReportClosedException When report is closed.
     */
    public function addAttachment(string $name): AttachmentBuilderInterface;

    /**
     * Build an diff entry.
     *
     * @param string $name The internal name of the diff.
     *
     * @return DiffBuilderInterface
     *
     * @throws ReportClosedException When report is closed.
     */
    public function addDiff(string $name): DiffBuilderInterface;

    /**
     * Closes the report with the passed status.
     *
     * @param string $status The status of the report (either self::STATUS_PASSED or self::STATUS_FAILED).
     *
     * @throws ReportClosedException When the report has been closed previously.
     */
    public function close(string $status): void;

    /**
     * Get the status of the report.
     *
     * @return string (either self::STATUS_STARTED, STATUS_PASSED or self::STATUS_FAILED, STATUS_SKIPPED).
     */
    public function getStatus() : string;
}
