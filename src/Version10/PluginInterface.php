<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\ConfigurationOptionsBuilderInterface;

/**
 * This interface describes the root for generic phpcq plugins.
 *
 * A generic plugin has a name and may describe it's configuration. A generic plugin does not specify which purpose it
 * has by itself and you therefore have to implement one or more of it's child interfaces.
 */
interface PluginInterface
{
    /**
     * The unique name of the plugin.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Describe available config options.
     *
     * @param ConfigurationOptionsBuilderInterface $configOptionsBuilder The config options builder.
     */
    public function describeOptions(ConfigurationOptionsBuilderInterface $configOptionsBuilder): void;
}
