<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes an int option.
 */
interface IntOptionBuilderInterface extends OptionBuilderInterface
{
    public function withDefaultValue(int $value): self;
}
