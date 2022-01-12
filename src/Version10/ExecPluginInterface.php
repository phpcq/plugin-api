<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Definition\ExecTaskDefinitionBuilderInterface;
use Phpcq\PluginApi\Version10\Task\OutputWritingTaskInterface;
use Phpcq\PluginApi\Version10\Task\TaskInterface;

/**
 * This interface describes plugins providing executable tasks.
 */
interface ExecPluginInterface extends PluginInterface
{
    /**
     * Describe the exec task which is provided by the plugin.
     *
     * @param ExecTaskDefinitionBuilderInterface $definitionBuilder The exec task definition builder.
     * @param EnvironmentInterface               $environment       The environment.
     */
    public function describeExecTask(
        ExecTaskDefinitionBuilderInterface $definitionBuilder,
        EnvironmentInterface $environment
    ): void;

    /**
     * Create exec task for the given arguments.
     *
     * @param string|null          $application The application name used to determine a specific application.
     * @param list<string>         $arguments   The console arguments passed through to the task.
     * @param EnvironmentInterface $environment The environment.
     *
     * @return TaskInterface
     */
    public function createExecTask(
        ?string $application,
        array $arguments,
        EnvironmentInterface $environment
    ): TaskInterface;
}
