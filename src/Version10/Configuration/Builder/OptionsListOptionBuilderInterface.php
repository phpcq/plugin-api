<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface OptionsListOptionBuilderInterface extends OptionBuilderInterface
{
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
     * @psalm-param list<array<string,mixed>> $defaultValue
     *
     * @return $this
     */
    public function withDefaultValue(array $defaultValue): self;
}
