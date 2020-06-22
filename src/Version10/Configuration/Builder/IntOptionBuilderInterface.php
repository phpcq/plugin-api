<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Option builder describing an int option.
 */
interface IntOptionBuilderInterface extends OptionBuilderInterface
{
    /**
     * Define a default value.
     *
     * The default value is used then no value is configured.
     *
     * @return $this
     */
    public function withDefaultValue(int $defaultValue): self;
}
