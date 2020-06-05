<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @extends IteratorAggregate<string, ConfigurationOptionInterface>
 */
interface ConfigurationOptionsInterface extends IteratorAggregate, Countable
{
    /**
     * Iterate over the configuration options.
     *
     * @return ConfigurationOptionInterface[]|Traversable
     *
     * @psalm-return Traversable<string, ConfigurationOptionInterface>
     */
    public function getIterator(): Traversable;

    /**
     * Validate the passed configuration array.
     *
     * @param array $config The configuration to validate.
     *
     * @throws InvalidConfigException When configuration is not valid.
     */
    public function validateConfig(array $config): void;
}
