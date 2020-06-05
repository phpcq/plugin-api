<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

/**
 * This interface describes a task to run.
 */
interface TaskRunnerInterface
{
    /**
     * Run the task.
     *
     * @param OutputInterface $output The output interface where the task shall write to.
     *
     * @throws RuntimeException When task fails.
     */
    public function run(OutputInterface $output): void;
}
