<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Countable;
use IteratorAggregate;
use Traversable;

interface ConfigurationOptionsInterface extends IteratorAggregate, Countable
{
    /**
     * @return Traversable
     */
    public function getIterator(): Traversable;

    /**
     * @param array $config
     *
     * @throws InvalidConfigException When configuration is not valid.
     */
    public function validateConfig(array $config): void;
}
