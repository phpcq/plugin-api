<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes an prototype option.
 *
 * A prototype option is an array with string key containing same values. The value has to be explicit described.
 */
interface PrototypeBuilderInterface extends OptionBuilderInterface
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
     * Declare a list of object like items.
     *
     * @return OptionsBuilderInterface
     */
    public function ofOptionsValue(): OptionsBuilderInterface;

    /**
     * Define a bool prototype value.
     */
    public function ofBoolValue(): BoolOptionBuilderInterface;

    /**
     * Define an enum prototype value.
     *
     * @return EnumOptionBuilderInterface
     */
    public function ofEnumValue(): EnumOptionBuilderInterface;

    /**
     * Define a float prototype value.
     */
    public function ofFloatValue(): FloatOptionBuilderInterface;

    /**
     * Define an integer prototype value.
     */
    public function ofIntValue(): IntOptionBuilderInterface;

    /**
     * Define a string list prototype value.
     */
    public function ofStringListValue(): StringListOptionBuilderInterface;

    /**
     * Define an options list prototype value.
     */
    public function ofOptionsListValue(): OptionsListOptionBuilderInterface;

    /**
     * Define a string prototype value.
     */
    public function ofStringValue(): StringOptionBuilderInterface;

    /**
     * Define a prototype vale.
     *
     * @return PrototypeBuilderInterface
     */
    public function ofPrototypeValue(): PrototypeBuilderInterface;

    /**
     * Define a default value.
     *
     * The default value is used then no value is configured.
     *
     * @psalm-param array<string, mixed> $defaultValue
     */
    public function withDefaultValue(array $defaultValue): self;
}
