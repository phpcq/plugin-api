<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\PluginConfigurationBuilderInterface;

interface ConfigurationPluginInterface extends PluginInterface
{
    /**
     * Describe available config options.
     *
     * @param PluginConfigurationBuilderInterface $configOptionsBuilder The config options builder.
     */
    public function describeConfiguration(PluginConfigurationBuilderInterface $configOptionsBuilder): void;
}
