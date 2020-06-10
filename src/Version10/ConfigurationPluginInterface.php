<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\ConfigurationOptionsBuilderInterface;
use Phpcq\PluginApi\Version10\Task\TaskInterface;

interface ConfigurationPluginInterface extends PluginInterface
{
    /**
     * Describe available config options.
     *
     * @param ConfigurationOptionsBuilderInterface $configOptionsBuilder The config options builder.
     */
    public function describeOptions(ConfigurationOptionsBuilderInterface $configOptionsBuilder): void;

    /**
     * Process plugin configuration and create task runners.
     *
     * @param array                $config      The plugin configuration.
     * @param EnvironmentInterface $buildConfig The build configuration.
     *
     * @return TaskInterface[]
     *
     * @psalm-return \Generator<int, TaskInterface>
     */
    public function processConfig(array $config, EnvironmentInterface $buildConfig): iterable;
}
