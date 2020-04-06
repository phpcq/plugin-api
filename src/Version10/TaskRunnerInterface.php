<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface TaskRunnerInterface
{
    /**
     * Run the task.
     *
     * @param OutputInterface $output
     *
     * @throws RuntimeException When task fails.
     */
    public function run(OutputInterface $output): void;
}
