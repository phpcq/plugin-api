<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Configuration\Builder\OptionsBuilderInterface;

interface ConfigurationOptionsBuilderInterface extends OptionsBuilderInterface
{
    public function getOptions(): ConfigurationOptionsInterface;
}
