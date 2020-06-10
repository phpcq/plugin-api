<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Exception\InvalidConfigurationException;

interface ConfigurationOptionInterface
{
    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get type.
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get default value.
     *
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * Returns true if config option is required.
     *
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * Validate a given value.
     *
     * @param mixed $value Given value.
     *
     * @throws InvalidConfigurationException When an invalid value is detected.
     */
    public function validateValue($value): void;
}
