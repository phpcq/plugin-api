<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Option builder describing an int option.
 */
interface IntOptionBuilderInterface extends OptionBuilderInterface
{
    /**
     * Mark option as required.
     */
    public function isRequired(): self;

    /**
     * Normalize a value for the required format. The normalizer is called before the validator.
     *
     * @param callable $normalizer
     * @psalm-param callable(mixed): mixed $normalizer
     */
    public function withNormalizer(callable $normalizer): self;

    /**
     * Register a validator which validates the given value.
     *
     * A validator has to throw a \Phpcq\PluginApi\Version10\Exception\InvalidConfigurationException if an invalid value
     * is given.
     *
     * @param callable $validator
     * @psalm-param callable(mixed): void $validator
     */
    public function withValidator(callable $validator): self;

    /**
     * Define a default value.
     *
     * The default value is used then no value is configured.
     *
     * @return $this
     */
    public function withDefaultValue(int $defaultValue): self;
}
