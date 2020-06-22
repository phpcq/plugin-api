<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface EnumOptionBuilderInterface
{
    public function ofStringValues(string ...$values): StringOptionBuilderInterface;

    public function ofIntValues(int ...$values): IntOptionBuilderInterface;

    public function ofFloatValues(float ...$values): FloatOptionBuilderInterface;
}
