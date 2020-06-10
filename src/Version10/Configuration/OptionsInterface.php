<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;

/**
 * The options interface describes a set of options.
 */
interface OptionsInterface
{
    /**
     * Get an integer option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getInt(string $name): int;

    /**
     * Get an integer option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getString(string $name): string;

    /**
     * Get an integer option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getFloat(string $name): string;

    /**
     * Get an integer option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getBool(string $name): string;

    /**
     * @psalm-return list
     */
    public function getList(string $name): array;

    /**
     * Get an integer option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getArray(string $name): OptionsInterface;

    /**
     * Check if option exists.
     *
     * @return bool
     */
    public function has(string $name): bool;
}
