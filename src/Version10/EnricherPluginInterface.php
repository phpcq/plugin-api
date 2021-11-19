<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\PluginConfigurationInterface;

/**
 * This interface describes an enricher plugin which is designed to enrich the configuration of another plugin.
 */
interface EnricherPluginInterface extends ConfigurationPluginInterface
{
    /**
     * Enriches the configuration of a specific other
     * @param string                       $pluginName The name of the plugin which is enriched.
     * @param array                        $pluginConfig The current plugin configuration.
     * @param PluginConfigurationInterface $config The configuration of the enricher plugin itself.
     * @param EnvironmentInterface         $environment The environment for the
     *
     * @return array
     */
    public function enrich(
        string $pluginName,
        array $pluginConfig,
        PluginConfigurationInterface $config,
        EnvironmentInterface $environment
    ): array;
}
