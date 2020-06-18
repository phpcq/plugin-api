<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;

/**
 * @psalm-template TParent
 */
interface NodeBuilderInterface
{
    /**
     * Get the parent node builder.
     *
     * @return NodeBuilderInterface
     *
     * @psalm-return TParent
     *
     * @throws RuntimeException When no parent node exists.
     */
    public function end(): NodeBuilderInterface;
}