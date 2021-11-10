<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * This interface describes a command option.
 */
interface CommandOptionBuilderInterface
{
    /**
     * Mark the option as required. If not defined the option is considered as optional.
     *
     * @return self
     */
    public function isRequired(): self;

    /**
     * Mark the option as an array if the option may occur multiple times.
     *
     * @return self
     */
    public function isArray(): self;

    /**
     * Declare that a value is required for this option.
     *
     * @return self
     */
    public function withRequiredValue(): self;

    /**
     * Declare that a value is optional for this option. A default value may be defined also.
     *
     * @param mixed $defaultValue The default value.
     *
     * @return self
     */
    public function withOptionalValue($defaultValue = null): self;
}
