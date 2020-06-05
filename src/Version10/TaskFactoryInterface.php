<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface TaskFactoryInterface
{
    /**
     * Create a task runner builder to exec an arbitrary process.
     *
     * @param string   $toolName The name of the tool to run (will get used for reporting).
     * @param string[] $command  The command to execute.
     *                           Pass the executable to run as first and arguments each as separate array item.
     *
     * @return TaskRunnerBuilderInterface
     */
    public function buildRunProcess(string $toolName, array $command): TaskRunnerBuilderInterface;

    /**
     * @param string $toolName    The name of the tool to run (will get used for determining the phar file and for
     *                            reporting).
     * @param string[] $arguments The arguments to pass to the phar file.
     *
     * @return TaskRunnerBuilderInterface
     */
    public function buildRunPhar(string $toolName, array $arguments = []): TaskRunnerBuilderInterface;

    /**
     * Create a report instance.
     *
     * @param string $toolName The name of the tool to create a report for.
     *
     * @return ToolReportInterface
     */
    public function createToolReport(string $toolName): ToolReportInterface;
}
