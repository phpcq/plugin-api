<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes a float option.
 */
interface StringOptionBuilderInterface extends OptionBuilderInterface
{
    public function withDefaultValue(string $value): self;
}
