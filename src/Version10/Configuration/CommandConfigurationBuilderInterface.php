<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration;

use Phpcq\PluginApi\Version10\Configuration\Builder\CommandArgumentBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\Builder\CommandOptionBuilderInterface;

/**
 * This interface describes a console command with it's supported arguments and options.
 */
interface CommandConfigurationBuilderInterface
{
    /**
     * Adds a description to the command.
     *
     * @return self
     */
    public function withDescription(string $description): self;

    /**
     * Adds a new argument to the command with a name and a description.
     *
     * The order of the arguments descriptions defines the order of the exepected arguments.
     */
    public function describeArgument(string $name, string $description): CommandArgumentBuilderInterface;

    /**
     * Adds a new option to the command with a name and a description.
     */
    public function describeOption(string $name, string $description): CommandOptionBuilderInterface;

    /**
     * Adds a sub command to the command.
     *
     * This allows to structure the command configuration into sub commands.
     */
    public function describeSubCommand(string $name): CommandConfigurationBuilderInterface;
}
