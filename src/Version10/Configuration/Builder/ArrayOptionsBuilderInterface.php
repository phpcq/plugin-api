<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface ArrayOptionsBuilderInterface describes an array (hash map) of different options.
 */
interface ArrayOptionsBuilderInterface extends OptionBuilderInterface
{
    /**
     * Describe a bool option interface and return its builder
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeBoolOption(string $name, string $description): ArrayBoolOptionBuilderInterface;

    /**
     * Describe a float option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeFloatOption(string $name, string $description): ArrayFloatOptionBuilderInterface;

    /**
     * Describe an integer option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeIntOption(string $name, string $description): ArrayIntOptionBuilderInterface;

    /**
     * Describe a string option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     */
    public function describeStringOption(string $name, string $description): ArrayStringOptionBuilderInterface;

    /**
     * Describe an enum option and return its builder.
     *
     * @param string $name        The option name.
     * @param string $description Description of the options.
     */
    public function describeEnumOption(string $name, string $description): ArrayEnumOptionBuilderInterface;
}
