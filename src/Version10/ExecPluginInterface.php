<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\ExecTaskConfigurationBuilderInterface;
use Phpcq\PluginApi\Version10\Task\OutputWritingTaskInterface;

/**
 * This interface describes plugins providing executable tasks.
 */
interface ExecPluginInterface extends PluginInterface
{
    /**
     * Describe the exec task which is provided by the plugin.
     *
     * @param ExecTaskConfigurationBuilderInterface $configurationBuilder The exec task configuration builder.
     */
    public function describeExecTask(ExecTaskConfigurationBuilderInterface $configurationBuilder): void;

    /**
     * Create exec task for the given arguments.
     *
     * @param string|null          $application The application name used to determine a specific application.
     * @param list<string>         $arguments   The console arguments passed through to the task.
     * @param EnvironmentInterface $environment The environment.
     *
     * @return OutputWritingTaskInterface
     */
    public function createExecTask(
        ?string $application,
        array $arguments,
        EnvironmentInterface $environment
    ): OutputWritingTaskInterface;
}
