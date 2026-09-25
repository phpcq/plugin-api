<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\PluginConfigurationInterface;
use Phpcq\PluginApi\Version10\Task\TaskInterface;

/**
 * A plugin which is able to fix issues automatically.
 *
 * The fix tasks are executed sequentially in "phpcq fix" before the diagnostics are run.
 */
interface FixPluginInterface extends ConfigurationPluginInterface
{
    /**
     * The stage in which the fix tasks are executed. The project configuration may override it.
     */
    public function getFixStage(): FixStage;

    /**
     * Process plugin configuration and create fix tasks.
     *
     * @param PluginConfigurationInterface $config      The plugin configuration.
     * @param EnvironmentInterface         $environment The build configuration.
     *
     * @return TaskInterface[]
     *
     * @psalm-return \Generator<int, TaskInterface>
     */
    public function createFixTasks(
        PluginConfigurationInterface $config,
        EnvironmentInterface $environment
    ): iterable;
}
