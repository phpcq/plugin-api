<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

/**
 * This interface describes a task to run.
 */
interface TaskInterface
{
    /**
     * Get the name of the tool the task belongs to.
     *
     * @return string
     */
    public function getToolName(): string;
}
