<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Task;

use Phpcq\PluginApi\Version10\Output\OutputTransformerFactoryInterface;
use Traversable;

interface TaskBuilderInterface
{
    /**
     * Use the passed working directory.
     *
     * @param string $cwd The working directory to use in the task runner.
     *
     * @return self
     */
    public function withWorkingDirectory(string $cwd): self;

    /**
     * Use the passed environment.
     *
     * @param string[] $env
     *
     * @return self
     */
    public function withEnv(array $env): self;

    /**
     * Use the passed input for the process.
     *
     * @param resource|string|Traversable $input The input as stream resource, scalar or Traversable, or null for no
     *                                           input.
     *
     * @return self
     */
    public function withInput($input): self;

    /**
     * Use the passed timeout (in seconds).
     *
     * @param int|float $timeout The timeout in seconds.
     *
     * @return self
     */
    public function withTimeout($timeout): self;

    /**
     * Use a custom output transformer.
     *
     * @param OutputTransformerFactoryInterface $factory The transformer factory.
     *
     * @return self
     */
    public function withOutputTransformer(OutputTransformerFactoryInterface $factory): self;

    /**
     * Disable parallel execution for this task.
     *
     * @return $this
     */
    public function forceSingleProcess(): self;

    /**
     * Set the count of "threads" this task consumes.
     *
     * The default is 1 and should only be increased if the executed tool in fact forks itself or is multi-threaded.
     *
     * This is mutually exclusive for single process tasks.
     *
     * @param int $cost The cost factor.
     *
     * @return $this
     */
    public function withCosts(int $cost): self;

    /**
     * Build the task runner.
     *
     * @return TaskInterface
     */
    public function build(): TaskInterface;
}
