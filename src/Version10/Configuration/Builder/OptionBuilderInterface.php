<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes a base option builder. It's designed as base for type based option builders.
 *
 * @psalm-tempate TParent
 * @psalm-template TType
 * @implements NodeBuilderInterface<TParent>
 */
interface OptionBuilderInterface extends NodeBuilderInterface
{
    /**
     * Mark option as required.
     */
    public function isRequired(): self;

    /**
     * Normalize a value for the required format. The normalizer is called before the validator.
     *
     * @param callable $normalizer
     * @psalm-param callable(mixed): TType $normalizer
     */
    public function withNormalizer(callable $normalizer): self;

    /**
     * Register a validator which validates the given value.
     *
     * A validator has to throw a \Phpcq\PluginApi\Version10\Exception\InvalidConfigurationException if an invalid value
     * is given.
     *
     * @param callable $validator
     * @psalm-param callable(mixed) $validator
     */
    public function withValidator(callable $validator): self;

    /** @psalm-param TType $defaultValue */
    public function withDefaultValue($defaultValue): self;

    /** @psalm-return NodeBuilderInterface<TParent> */
    public function end(): NodeBuilderInterface;
}
