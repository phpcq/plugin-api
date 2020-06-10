<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Task\TaskInterface;

/**
 * This interface describes plugins providing diagnostic tasks.
 */
interface DiagnosticTasksInterface extends PluginInterface
{
    /**
     * Process plugin configuration and create tasks.
     *
     * @param array                $config      The plugin configuration.
     * @param EnvironmentInterface $buildConfig The build configuration.
     *
     * @return TaskInterface[]
     *
     * @psalm-return \Generator<int, TaskInterface>
     */
    public function createDiagnosticTasks(array $config, EnvironmentInterface $buildConfig): iterable;
}