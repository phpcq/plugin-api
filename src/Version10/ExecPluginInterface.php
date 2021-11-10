<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\CommandConfigurationBuilderInterface;
use Phpcq\PluginApi\Version10\Task\OutputWritingTaskInterface;

/**
 * This interface describes plugins providing executable tasks.
 */
interface ExecPluginInterface extends PluginInterface
{
    /**
     * Describe the exec task which is is provided by the plugin.
     *
     * @param CommandConfigurationBuilderInterface $configurationBuilder The command configuration builder.
     */
    public function describeExecTask(CommandConfigurationBuilderInterface $configurationBuilder): void;

    /**
     * Create exec task for the given arguments.
     *
     * @param list<string>         $arguments   The console arguments passed through to the task.
     * @param EnvironmentInterface $environment The environment.
     *
     * @return OutputWritingTaskInterface
     */
    public function createExecTask(array $arguments, EnvironmentInterface $environment): OutputWritingTaskInterface;
}
