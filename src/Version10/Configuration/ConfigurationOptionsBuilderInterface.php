<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Configuration\Builder\ArrayOptionsBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\BoolOptionBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\EnumOptionBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\FloatOptionBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\IntOptionBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\ListOptionBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\StringOptionBuilderInterface;

interface ConfigurationOptionsBuilderInterface
{
    /**
     * Create a sub array configuration and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     *
     * @return ArrayOptionsBuilderInterface
     */
    public function describeArrayOption(string $name, string $description): ArrayOptionsBuilderInterface;


    /**
     * Describe a bool option interface and return its builder
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
     * Describe a list option and return its builder.
     *
     * @param string $name        The option name.
     * @param string $description Description of the options.
     */
    public function describeListOption(string $name, string $description): ListOptionBuilderInterface;

    /**
     * Describe an enum option and return its builder.
     *
     * @param string $name        The option name.
     * @param string $description Description of the options.
     */
    public function describeEnumOption(string $name, string $description): EnumOptionBuilderInterface;
}
