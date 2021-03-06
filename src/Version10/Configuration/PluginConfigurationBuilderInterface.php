<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Configuration\Builder\OptionsBuilderInterface;

/**
 * Interface describes the configuration builder for a plugin.
 *
 * Each plugin supporting configuration has to describe it's own configuration.
 */
interface PluginConfigurationBuilderInterface extends OptionsBuilderInterface
{
    /**
     * Enable support for directory based configurations.
     *
     * If enabled it's possible to provide directory specific configurations. Furthermore plugins expecting the
     * \Phpcq\PluginApi\Version10\Configuration\PluginConfigurationInterface will get an list option directories for
     * which the passed configuration applies to.
     *
     * @return $this
     */
    public function supportDirectories(): self;
}
