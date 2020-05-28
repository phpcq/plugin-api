<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface TaskFactoryInterface
{
    /**
     * @param string   $toolName
     * @param string[] $command
     *
     * @return TaskRunnerBuilderInterface
     */
    public function buildRunProcess(string $toolName, array $command): TaskRunnerBuilderInterface;

    /**
     * @param string   $toolName
     * @param string[] $arguments
     *
     * @return TaskRunnerBuilderInterface
     */
    public function buildRunPhar(string $toolName, array $arguments = []): TaskRunnerBuilderInterface;
}
