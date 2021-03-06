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
     * Get a string option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getString(string $name): string;

    /**
     * Get a float option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getFloat(string $name): float;

    /**
     * Get a bool option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getBool(string $name): bool;

    /**
     * @return string[]
     * @psalm-return list<string>
     */
    public function getStringList(string $name): array;

    /**
     * @return OptionsInterface[]
     * @psalm-return list<array<string, mixed>>
     */
    public function getOptionsList(string $name): array;

    /**
     * Get an array option by name.
     *
     * @throws RuntimeException When option does not exist.
     */
    public function getOptions(string $name): array;

    /**
     * Check if option exists.
     *
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * Return raw value of an array.
     *
     * @return array
     */
    public function getValue(): array;
}
