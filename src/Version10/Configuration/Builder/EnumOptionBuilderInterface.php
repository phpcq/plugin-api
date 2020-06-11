<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface EnumOptionBuilderInterface extends OptionBuilderInterface
{
    public function ofStringValues(string ...$values): self;

    public function ofIntValues(string ...$values): self;

    public function ofFloatValues(float ...$values): self;

    /** @param string|int|float $defaultValue */
    public function withDefaultValue($defaultValue): self;
}
