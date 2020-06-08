<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\PluginApi\Version10\OutputInterface;
use Phpcq\PluginApi\Version10\RuntimeException;

interface OutputWritingTaskInterface extends TaskInterface
{
    /**
     * Run the task.
     *
     * @param OutputInterface $output The output interface where the task shall write to.
     *
     * @throws RuntimeException When task fails.
     */
    public function runForOutput(OutputInterface $output): void;
}
