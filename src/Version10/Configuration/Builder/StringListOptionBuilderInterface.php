<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface StringListOptionBuilderInterface extends OptionBuilderInterface
{
    /**
     * Define a default value.
     *
     * The default value is used then no value is configured.
     *
     * @psalm-param list<string> $defaultValue
     *
     * @return $this
     */
    public function withDefaultValue(array $defaultValue): self;
}
