<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes a list option of same values.
 */
interface ListOptionBuilderInterface extends OptionBuilderInterface
{
    /**
     * Declare list of string items.
     *
     * @return $this
     */
    public function ofStringItems(): self;

    /**
     * Declare list of float items.
     *
     * @return $this
     */
    public function ofFloatItems(): self;

    /**
     * Declare list of integer items.
     *
     * @return $this
     */
    public function ofIntItems(): self;

    /**
     * Declare a list of object like items.
     *
     * @return OptionsBuilderInterface
     * @psalm-return OptionsBuilderInterface<ListOptionBuilderInterface>
     */
    public function ofOptionsItems(): OptionsBuilderInterface;

    /**
     * Register a validator which validates a single item of the given list value.
     *
     * A validator has to throw a \Phpcq\PluginApi\Version10\Exception\InvalidConfigurationException if an invalid value
     * is given.
     *
     * @param callable $validator
     * @psalm-param callable(mixed) $validator
     */
    public function withItemValidator(callable $validator) : OptionBuilderInterface;
}
