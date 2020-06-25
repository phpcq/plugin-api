<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

/**
 * ProjectConfigInterface describes the global configuration of the current project
 */
interface ProjectConfigInterface
{
    /**
     * Get the root directory of the path.
     *
     * @return string
     */
    public function getProjectRootPath(): string;

    /**
     * Get list of source directories.
     *
     * @return string[]
     */
    public function getDirectories(): array;

    /**
     * Get the artifact output path.
     *
     * @return string
     */
    public function getArtifactOutputPath(): string;

    /**
     * Get the number of maximal supported cpu cores.
     *
     * @return int
     */
    public function getMaxCpuCores(): int;
}
