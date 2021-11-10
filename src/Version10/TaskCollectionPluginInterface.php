<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Phpcq\PluginApi\Version10\Configuration\PluginConfigurationInterface;

/**
 * This plugin provides a list of task names which should be executed.
 */
interface TaskCollectionPluginInterface extends ConfigurationPluginInterface
{
    /** @return list<string> */
    public function getTaskNames(PluginConfigurationInterface $pluginConfiguration): array;
}
