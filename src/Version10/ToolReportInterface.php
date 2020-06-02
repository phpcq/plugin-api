<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface ToolReportInterface
{
    public const STATUS_STARTED = ReportInterface::STATUS_STARTED;
    public const STATUS_PASSED  = ReportInterface::STATUS_PASSED;
    public const STATUS_FAILED  = ReportInterface::STATUS_FAILED;

    public const SEVERITY_INFO  = 'info';
    public const SEVERITY_WARNING = 'warning';
    public const SEVERITY_ERROR = 'error';

    /**
     * Add an diagnostic entry.
     *
     * @param string      $severity The severity of the error - one of the self::SEVERITY_* constants.
     * @param string      $message  The error message.
     * @param string|null $file     The file of the error.
     * @param int|null    $line     The line the error is on (within the file).
     * @param int|null    $column   The column the error is on (within the line).
     * @param string|null $source   The optional source of the error.
     */
    public function addDiagnostic(
        string $severity,
        string $message,
        ?string $file = null,
        ?int $line = null,
        ?int $column = null,
        ?string $source = null
    ): void;

    /**
     * Add an attachment to the tool report.
     *
     * @param string      $filePath The absolute path to the attachment file.
     * @param string|null $name     The internal name of the attachment. Defaults to the basename of the passed file.
     *
     * @return void
     */
    public function addAttachment(string $filePath, ?string $name = null): void;

    /**
     * Add an attachment to the tool report.
     *
     * @param string $buffer The file buffer.
     * @param string $name   The internal name of the attachment.
     *
     * @return void
     */
    public function addBufferAsAttachment(string $buffer, string $name): void;

    /**
     * Closes the report with the passed status.
     *
     * @param string $status The status of the report (either self::STATUS_PASSED or self::STATUS_FAILED).
     *
     * @throws ReportClosedException When the report has been closed previously.
     */
    public function finish(string $status): void;
}
