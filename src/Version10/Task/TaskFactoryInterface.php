<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\Task\TaskBuilder;

interface TaskFactoryInterface
{
    /**
     * Create a task runner builder to exec an arbitrary process.
     *
     * @param string   $toolName The name of the tool to run (will get used for reporting).
     * @param string[] $command  The command to execute.
     *                           Pass the executable to run as first and arguments each as separate array item.
     *
     * @return TaskBuilderInterface
     */
    public function buildRunProcess(string $toolName, array $command): TaskBuilderInterface;

    /**
     * @param string $toolName    The name of the tool to run (will get used for determining the phar file and for
     *                            reporting).
     * @param string[] $arguments The arguments to pass to the phar file.
     *
     * @return TaskBuilderInterface
     */
    public function buildRunPhar(string $toolName, array $arguments = []): TaskBuilderInterface;

    /**
     * Create a task runner builder to exec a php process.
     *
     * @param string   $toolName  The name of the tool to run (will get used for reporting).
     * @param string[] $arguments The arguments to pass to the php process.
     *                            Pass the executable to run as first and arguments each as separate array item.
     *
     * @return TaskBuilderInterface
     */
    public function buildPhpProcess(string $toolName, array $arguments = []): TaskBuilderInterface;
}
