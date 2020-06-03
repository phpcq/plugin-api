<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

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
     * @param BuildConfigInterface $buildConfig The build configuration.
     *
     * @return TaskRunnerInterface[]
     *
     * @psalm-return \Generator<int, TaskRunnerInterface>
     */
    public function processConfig(array $config, BuildConfigInterface $buildConfig): iterable;
}
