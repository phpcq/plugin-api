<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Task\TaskFactoryInterface;

interface EnvironmentInterface
{
    /**
     * Get the project configuration.
     *
     * @return ProjectConfigInterface
     */
    public function getProjectConfiguration(): ProjectConfigInterface;

    /**
     * Get the task factory.
     *
     * @return TaskFactoryInterface
     */
    public function getTaskFactory(): TaskFactoryInterface;

    /**
     * Get the temporary dir for the current build.
     *
     * @return string
     */
    public function getBuildTempDir(): string;

    /**
     * Obtain an unique temp file name.
     *
     * @param PluginInterface|null $plugin Optional plugin to use in file name prefix.
     * @param string|null          $suffix Optional manual suffix to use in file name.
     *
     * @return string
     */
    public function getUniqueTempFile(?PluginInterface $plugin = null, ?string $suffix = null): string;

    /**
     * Return the amount of available threads to consume.
     *
     * @return int
     */
    public function getAvailableThreads(): int;
}
