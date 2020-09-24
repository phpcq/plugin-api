<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Report;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;

interface AttachmentBuilderInterface
{
    /**
     * Load the contents from a reachable file.
     *
     * @param string $file The absolute path to the attachment file.
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
     * Set an MimeType for the attachment.
     *
     * See: http://www.iana.org/assignments/media-types/media-types.xhtml
     *
     * @param string $mimeType The MIME type.
     *
     * @return $this
     */
    public function setMimeType(string $mimeType): self;

    /**
     * End the builder instance.
     *
     * After calling this, no further calls will have any effect.
     *
     * @return TaskReportInterface
     *
     * @throws RuntimeException When no content has been set.
     */
    public function end(): TaskReportInterface;
}
