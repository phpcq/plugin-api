<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Option builder describing a float option.
 */
interface FloatOptionBuilderInterface extends OptionBuilderInterface
{
    /**
     * Define a default value.
     *
     * The default value is used then no value is configured.
     *
     * @return $this
     */
    public function withDefaultValue(float $defaultValue): self;
}
