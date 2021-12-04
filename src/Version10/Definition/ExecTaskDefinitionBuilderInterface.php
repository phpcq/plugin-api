<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Definition;

use Phpcq\PluginApi\Version10\Definition\Builder\ConsoleApplicationBuilderInterface;

interface ExecTaskDefinitionBuilderInterface
{
    /**
     * Describes a console application provided by the plugin.
     *
     * If the plugin provides multiple console applications, a dedicated application name is required so that the
     * application will be available as plugin:application. If no application name is provided the application is
     * available using the plugin name.
     */
    public function describeApplication(
        string $description,
        ?string $applicationName = null
    ): ConsoleApplicationBuilderInterface;
}
