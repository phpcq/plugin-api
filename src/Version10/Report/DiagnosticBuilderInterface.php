<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Report;

use Phpcq\PluginApi\Version10\ToolReportInterface;

interface DiagnosticBuilderInterface
{
    /**
     * Add a file reference to the current diagnostic.
     *
     * @param string $file The path to the file, either absolute or relative to project root.
     *
     * @return FileDiagnosticBuilderInterface
     */
    public function forFile(string $file): FileDiagnosticBuilderInterface;

    /**
     * The optional source of the diagnostic.
     *
     * This may be the name of a check rule within the tool or the like.
     *
     * @param string $source The source of the diagnostic.
     *
     * @return $this
     */
    public function fromSource(string $source): self;

    /**
     * End the builder instance.
     *
     * After calling this, no further calls will have any effect.
     *
     * @return ToolReportInterface
     */
    public function end(): ToolReportInterface;
}