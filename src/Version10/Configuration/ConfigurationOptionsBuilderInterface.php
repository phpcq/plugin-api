<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Configuration\Builder\ArrayOptionsBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\EnumOptionBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\ListOptionBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\OptionBuilderInterface;

interface ConfigurationOptionsBuilderInterface
{
    /**
     * Enable support for directory based configurations.
     *
     * If enabled it's possible to provide directory specific configurations. Furthermore plugins expecting the
     * \Phpcq\PluginApi\Version10\Configuration\PluginConfigurationInterface will get an list option directories for
     * which the passed configuration applies to.
     *
     * @return $this
     */
    public function supportDirectories(): self;

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
     *
     * @psalm-return OptionBuilderInterface<bool>
     */
    public function describeBoolOption(string $name, string $description): OptionBuilderInterface;

    /**
     * Describe a float option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     *
     * @psalm-return OptionBuilderInterface<float>
     */
    public function describeFloatOption(string $name, string $description): OptionBuilderInterface;

    /**
     * Describe an integer option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     *
     * @psalm-return OptionBuilderInterface<int>
     */
    public function describeIntOption(string $name, string $description): OptionBuilderInterface;

    /**
     * Describe a string option and return its builder.
     *
     * @param string $name        The name of the option.
     * @param string $description The description of the option.
     *
     * @psalm-return OptionBuilderInterface<string>
     */
    public function describeStringOption(string $name, string $description): OptionBuilderInterface;

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
