<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

interface PhpTaskBuilderInterface extends TaskBuilderInterface
{
    /**
     * Disable XDEBUG extension.
     *
     * @return self
     */
    public function withoutXDebug(): self;
}
