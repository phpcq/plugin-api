<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface ArrayOptionsBuilderInterface describes an array (hash map) of different options.
 */
interface OptionsBuilderInterface extends OptionBuilderInterface
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
     * Describe a sub object like array option and return its builder
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeOptions(string $name, string $description): OptionsBuilderInterface;

    /**
     * Describe a prototype and return its builder
     *
     * A prototype is an array of a variable set of string key => value entries.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the prototype.
     */
    public function describePrototypeOption(string $name, string $description): PrototypeBuilderInterface;

    /**
     * Describe a bool option and return its builder
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeBoolOption(string $name, string $description): BoolOptionBuilderInterface;

    /**
     * Describe a float option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeFloatOption(string $name, string $description): FloatOptionBuilderInterface;

    /**
     * Describe an integer option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeIntOption(string $name, string $description): IntOptionBuilderInterface;

    /**
     * Describe a string option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeStringOption(string $name, string $description): StringOptionBuilderInterface;

    /**
     * Describe an enum option and return its builder.
     *
     * @param string $name        The option name.
     * @param string $description Description of the options.
     */
    public function describeEnumOption(string $name, string $description): EnumOptionBuilderInterface;

    /**
     * Describe a list option and return its builder.
     *
     * @param string $name        The option name.
     * @param string $description Description of the options.
     */
    public function describeStringListOption(string $name, string $description): StringListOptionBuilderInterface;

    /**
     * Describe a list option and return its builder.
     *
     * @param string $name        The option name.
     * @param string $description Description of the options.
     */
    public function describeOptionsListOption(string $name, string $description): OptionsListOptionBuilderInterface;

    /**
     * Define a default value.
     *
     * The default value is used then no value is configured.
     *
     * @psalm-param array<string,mixed> $defaultValue
     *
     * @return $this
     */
    public function withDefaultValue(array $defaultValue): self;
}
