<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Report;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;

/**
 * This builds (unified) diffs attachments.
 *
 * https://www.gnu.org/software/diffutils/manual/html_node/Detailed-Unified.html
 */
interface DiffBuilderInterface
{
    /**
     * Load the contents from a reachable file.
     *
     * @param string $file The absolute path to the file.
     *
     * @return $this
     *
     * @throws RuntimeException When the path is not absolute.
     */
    public function fromFile(string $file): self;

    /**
     * Load the contents from a string.
     *
     * @param string $buffer The string buffer.
     *
     * @return $this
     */
    public function fromString(string $buffer): self;

    /**
     * End the builder instance.
     *
     * After calling this, no further calls will have any effect.
     *
     * @return ToolReportInterface
     */
    public function end(): ToolReportInterface;
}
