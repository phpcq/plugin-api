<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Configuration\Builder\ConsoleApplicationBuilderInterface;

interface ExecTaskConfigurationBuilderInterface
{
    /**
     * Describes a console application provided by the plugin.
     *
     * If the plugin provides multiple console applications, a dedicated task name is required so that the application
     * will be available as plugin:application. If no application name is provided the application is available using
     * the plugin name.
     *
     * This allows to structure the command configuration into sub commands.
     */
    public function describeApplication(?string $applicationName = null): ConsoleApplicationBuilderInterface;
}
