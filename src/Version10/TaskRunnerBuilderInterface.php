<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Traversable;

interface TaskRunnerBuilderInterface
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
     * Build the task runner.
     *
     * @return TaskRunnerInterface
     */
    public function build(): TaskRunnerInterface;
}
