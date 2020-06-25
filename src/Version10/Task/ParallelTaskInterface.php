<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;

/**
 * This interface describes a task that can be run in parallel to other tasks.
 *
 * Note that this base interface only handles the checking for completion and not the method how to start the task.
 * This is done in concrete interfaces.
 *
 * A task will be triggered via the ParallelTaskInterface::tick() method as long as the method returns true.
 *
 * To signal abnormal execution, a task may throw a RuntimeException from within the tick method only.
 */
interface ParallelTaskInterface extends TaskInterface
{
    /**
     * Called repeatedly by the scheduler to give a time slice to the task.
     *
     * The result is false if the task has finished or true if the task shall get notified in the next loop again.
     *
     * @return bool
     *
     * @throws RuntimeException When the task fails.
     */
    public function tick(): bool;

    /**
     * Return the cost factor of this task.
     *
     * This is the count of "threads" this task consumes and should return 1 if the tool is not multi threaded by
     * itself.
     *
     * @return int
     */
    public function getCost(): int;
}
