<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

/**
 * This class helps with parsing console output of tools.
 */
final class BufferedLineReader
{
    /** @var string */
    private $data = '';

    /**
     * Push data into the buffer.
     *
     * @param string $data The data to buffer.
     */
    public function push(string $data): void
    {
        $this->data .= $data;
    }

    /**
     * Fetch the next line from the buffer.
     *
     * @param bool $trim Flag if the result shall be trimmed.
     *
     * @return string|null
     */
    public function fetch(bool $trim = true): ?string
    {
        if (false === ($eol = strpos($this->data, "\n"))) {
            return null;
        }

        $line = substr($this->data, 0, $eol);
        $this->data = substr($this->data, $eol + 1);

        return $trim ? trim($line) : $line;
    }

    /**
     * Peek into the buffer without removing the line.
     *
     * @param bool $trim Flag if the result shall be trimmed.
     *
     * @return string|null
     */
    public function peek(bool $trim = true): ?string
    {
        if (false === ($eol = strpos($this->data, "\n"))) {
            return null;
        }

        $line = substr($this->data, 0, $eol);

        return $trim ? trim($line) : $line;
    }

    /**
     * Obtain the length of the buffer.
     *
     * @return int
     */
    public function getLength(): int
    {
        return strlen($this->data);
    }

    /**
     * Test if the buffer is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return 0 === $this->getLength();
    }
}
