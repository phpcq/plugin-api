<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface ArrayStringOptionBuilderInterface extends ArrayOptionBuilderInterface
{
    public function withDefaultValue(string $value): self;
}
