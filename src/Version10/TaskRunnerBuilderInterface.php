<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Traversable;

interface TaskRunnerBuilderInterface
{
    /**
     * Use the passed working directory.
     *
     * @return self
     */
    public function withWorkingDirectory(string $cwd): TaskRunnerBuilderInterface;

    /**
     * Use the passed environment.
     *
     * @param string[] $env
     *
     * @return self
     */
    public function withEnv(array $env): TaskRunnerBuilderInterface;

    /**
     * Use the passed input for the process.
     *
     * @param resource|string|Traversable $input The input as stream resource, scalar or Traversable, or null for no
     *                                           input
     *
     * @return self
     */
    public function withInput($input): TaskRunnerBuilderInterface;

    /**
     * Use the passed timeout (in seconds).
     *
     * @param int|float $timeout
     *
     * @return self
     */
    public function withTimeout($timeout): TaskRunnerBuilderInterface;

    /**
     * Use a custom output transformer.
     *
     * @param OutputTransformerFactoryInterface $factory The transformer factory.
     *
     * @return TaskRunnerBuilderInterface
     */
    public function withOutputTransformer(OutputTransformerFactoryInterface $factory): TaskRunnerBuilderInterface;

    /**
     * Build the task runner.
     *
     * @return TaskRunnerInterface
     */
    public function build(): TaskRunnerInterface;
}
