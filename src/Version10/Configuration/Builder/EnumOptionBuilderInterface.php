<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface EnumOptionBuilderInterface extends OptionBuilderInterface
{
    public function ofStringValues(string ...$values): self;

    public function ofIntValues(int ...$values): self;

    public function ofFloatValues(float ...$values): self;
}
