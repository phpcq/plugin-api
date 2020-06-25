<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Report;

use Phpcq\PluginApi\Version10\Exception\ReportClosedException;
use Phpcq\PluginApi\Version10\Exception\RuntimeException;

/**
 * @psalm-type TDiagnosticSeverity = ToolReportInterface::SEVERITY_NONE
 * |ToolReportInterface::SEVERITY_INFO
 * |ToolReportInterface::SEVERITY_MARGINAL
 * |ToolReportInterface::SEVERITY_MINOR
 * |ToolReportInterface::SEVERITY_MAJOR
 * |ToolReportInterface::SEVERITY_FATAL
 */
interface ToolReportInterface
{
    public const STATUS_STARTED = ReportInterface::STATUS_STARTED;
    public const STATUS_PASSED  = ReportInterface::STATUS_PASSED;
    public const STATUS_FAILED  = ReportInterface::STATUS_FAILED;
    public const STATUS_SKIPPED = 'skipped';

    /**
     * A non issue - strictly informational (additional debug info requested like tool execution argument -
     * only to be exported if threshold is set to none )
     */
    public const SEVERITY_NONE = 'none';

    /**
     * An non issue - strictly informational.
     */
    public const SEVERITY_INFO  = 'info';

    /**
     * Marginal issue - no immediate action has to be taken (could be info by tools like psalm).
     */
    public const SEVERITY_MARGINAL  = 'marginal';

    /**
     * A minor issue - action should be taken but is not required (could be code style violations or the like).
     */
    public const SEVERITY_MINOR  = 'minor';

    /**
     * A major issue - action MUST be taken (could be failing unit tests).
     */
    public const SEVERITY_MAJOR  = 'major';

    /**
     * A fatal issue - (could be missing dependencies or the like which make the project unusable).
     */
    public const SEVERITY_FATAL = 'fatal';

    /**
     * Build a diagnostic entry.
     *
     * @param string $severity The severity of the error - one of the self::SEVERITY_* constants.
     * @param string $message  The error message.
     *
     * @psalm-param TDiagnosticSeverity $severity
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
    public function getStatus(): string;
}
