<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Report;

interface FileDiagnosticBuilderInterface
{
    /**
     * Define the range within the file.
     *
     * @param int      $line      The starting line within the file.
     * @param int|null $column    The starting column (within the starting line).
     * @param int|null $endline   The end line within the file.
     * @param int|null $endcolumn The end column (within the end line).
     *
     * @return $this
     */
    // FIXME: rather make this a RangeBuilderInterface?
    public function forRange(int $line, ?int $column = null, ?int $endline = null, ?int $endcolumn = null): self;

    /**
     * End the builder instance.
     *
     * After calling this, no further calls will have any effect.
     *
     * @return DiagnosticBuilderInterface
     */
    public function end(): DiagnosticBuilderInterface;
}
