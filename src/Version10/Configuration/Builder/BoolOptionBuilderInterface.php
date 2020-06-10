<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface a bool option
 */
interface BoolOptionBuilderInterface extends OptionBuilderInterface
{
    public function withDefaultValue(bool $value): self;
}
