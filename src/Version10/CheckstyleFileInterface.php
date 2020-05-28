<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface CheckstyleFileInterface
{
    /**
     * Add an error of related to a file.
     */
    public function add(
        string $severity,
        string $message,
        string $toolName,
        ?string $source = null,
        ?int $line = null,
        ?int $column = null
    ): void;
}
