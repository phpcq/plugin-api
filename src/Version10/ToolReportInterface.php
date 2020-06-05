<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Report\AttachmentBuilderInterface;
use Phpcq\PluginApi\Version10\Report\DiagnosticBuilderInterface;

interface ToolReportInterface
{
    public const STATUS_STARTED = ReportInterface::STATUS_STARTED;
    public const STATUS_PASSED  = ReportInterface::STATUS_PASSED;
    public const STATUS_FAILED  = ReportInterface::STATUS_FAILED;

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
     * Closes the report with the passed status.
     *
     * @param string $status The status of the report (either self::STATUS_PASSED or self::STATUS_FAILED).
     *
     * @throws ReportClosedException When the report has been closed previously.
     */
    public function finish(string $status): void;
}
