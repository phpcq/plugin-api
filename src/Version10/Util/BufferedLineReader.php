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

    /** @var int */
    private $cursor = 0;

    /**
     * Creates an empty instance.
     *
     * @return static
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * Creates an instance initially populated from a string.
     *
     * @param string $data The initial data.
     *
     * @return static
     */
    public static function createFromString(string $data): self
    {
        $instance = new self();
        $instance->push($data);

        return $instance;
    }

    /**
     * Fetch the whole buffer contents.
     *
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Obtain the length of the contained data.
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
        return '' === $this->data;
    }

    /**
     * Obtain the current cursor position.
     *
     * @return int
     */
    public function getCursorPos(): int
    {
        return $this->cursor;
    }

    /**
     * Sets the cursor to an absolute position.
     *
     * The value is clamped to the buffer size.
     *
     * @param int $cursor The new cursor position.
     *
     * @return void
     */
    public function setCursorPos(int $cursor): void
    {
        $this->cursor = $this->clamp($cursor, 0, $this->getLength());
    }

    /**
     * Obtain the length of remaining bytes.
     *
     * @return int
     */
    public function getRemainingBytes(): int
    {
        return $this->getLength() - $this->cursor;
    }

    /**
     * Test if the cursor is at the end of the buffer.
     *
     * @return bool
     */
    public function isEOF(): bool
    {
        return 0 === $this->getRemainingBytes();
    }

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
     * Move the cursor the passed amount of bytes.
     *
     * The value is clamped to 0 ... buffer length.
     *
     * @param int $bytes The amount of bytes to move the cursor.
     *
     * @return void
     */
    public function move(int $bytes): void
    {
        if (0 === $bytes) {
            return;
        }

        $this->setCursorPos($this->getCursorPos() + $bytes);
    }

    /**
     * Locate the next occurrence of the passed search string relative to current cursor position and return the delta.
     *
     * @param string $search The string to search.
     *
     * @return int|null
     */
    public function locate(string $search): ?int
    {
        if ($this->getRemainingBytes() < strlen($search)) {
            return null;
        }
        if (false === ($pos = strpos($this->data, $search, $this->cursor))) {
            return null;
        }

        return $pos - $this->cursor;
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
        if (null === ($delta = $this->locate("\n"))) {
            return null;
        }
        $line = substr($this->data, $this->cursor, $delta);
        $this->move($delta + 1);

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
        if (null === ($delta = $this->locate("\n"))) {
            return null;
        }
        $line = substr($this->data, $this->cursor, $delta);

        return $trim ? trim($line) : $line;
    }

    /**
     * Clamp a value between min and max.
     *
     * @param int $value The value to clamp.
     * @param int $min   The minimum.
     * @param int $max   The maximum.
     *
     * @return int
     */
    private function clamp(int $value, int $min, int $max): int
    {
        return min($max, max($min, $value));
    }
}
