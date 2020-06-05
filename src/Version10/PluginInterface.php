<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

/**
 * This interface describes the root for generic phpcq plugins.
 *
 * A generic plugin does nothing by itself and you therefore have to implement one or more of it's child interfaces.
 */
interface PluginInterface
{
    public function getName(): string;
}
