<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface ArrayFloatOptionBuilderInterface extends ArrayOptionBuilderInterface
{
    public function withDefaultValue(float $value): self;
}
