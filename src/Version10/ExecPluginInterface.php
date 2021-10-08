<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\PluginConfigurationInterface;
use Phpcq\PluginApi\Version10\Task\TaskInterface;

/**
 * This interface describes plugins providing executable tasks.
 */
interface ExecPluginInterface extends PluginInterface
{
    /**
     * Process plugin configuration and create tasks.
     *
     * @param PluginConfigurationInterface $config      The plugin configuration.
     * @param EnvironmentInterface         $environment The build configuration.
     *
     * @return TaskInterface[]
     *
     * @psalm-return \Generator<int, TaskInterface>
     */
    public function createExecTasks(
        PluginConfigurationInterface $config,
        EnvironmentInterface $environment
    ): iterable;
}
