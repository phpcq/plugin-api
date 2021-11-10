<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * This interface describes a console command argument.
 */
interface CommandArgumentBuilderInterface
{
    /**
     * Mark the argument as required. If not defined the argument is considered as optional.
     *
     * @return self
     */
    public function isRequired(): self;

    /**
     * Mark the argument as an array if the argument may occur multiple times.
     *
     * @return self
     */
    public function isArray(): self;

    /**
     * Set a default value for the argument.
     *
     * @param mixed $value The default value.
     *
     * @return self
     */
    public function withDefaultValue($value): self;
}
