<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface TaskFactoryInterface
{
    /**
     * @param string[] $command
     *
     * @return TaskRunnerBuilderInterface
     */
    public function buildRunProcess(array $command): TaskRunnerBuilderInterface;

    /**
     * @param string   $pharName
     * @param string[] $arguments
     *
     * @return TaskRunnerBuilderInterface
     */
    public function buildRunPhar(string $pharName, array $arguments = []): TaskRunnerBuilderInterface;
}
