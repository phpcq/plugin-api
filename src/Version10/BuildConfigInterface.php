<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface BuildConfigInterface
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
     * @param string|null          $prefix Optional manual prefix to use in file name prefix.
     *
     * @return string
     */
    public function getUniqueTempFile(?PluginInterface $plugin = null, ?string $prefix = null): string;
}
