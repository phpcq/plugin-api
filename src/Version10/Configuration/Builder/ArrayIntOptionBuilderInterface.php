<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface ArrayIntOptionBuilderInterface extends ArrayOptionBuilderInterface
{
    public function withDefaultValue(int $value): self;
}
