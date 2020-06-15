<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\ConfigurationOptionsBuilderInterface;

interface ConfigurationPluginInterface extends PluginInterface
{
    /**
     * Describe available config options.
     *
     * @param ConfigurationOptionsBuilderInterface $configOptionsBuilder The config options builder.
     */
    public function describeConfiguration(ConfigurationOptionsBuilderInterface $configOptionsBuilder): void;
}
