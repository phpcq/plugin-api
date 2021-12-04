<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Definition\Builder;

use Phpcq\PluginApi\Version10\Exception\RuntimeException;

/**
 * Interface describes a console application provided by a plugin.
 *
 * An application may contain either commands or arguments.
 */
interface ConsoleApplicationBuilderInterface
{
    /**
     * Describe which value separator is used.
     *
     * If not defined, PHPCQ assumes that an equal sign is used.
     *
     * @param string $separator
     *
     * @return mixed
     */
    public function withOptionValueSeparator(string $separator): self;

    /**
     * Adds a new command to the console application.
     *
     * @param string $name        The command name.
     * @param string $description The command description.
     *
     * @return ConsoleCommandBuilderInterface
     *
     * @throws RuntimeException When a command with the name is already described or any argument is described.
     */
    public function describeCommand(string $name, string $description): ConsoleCommandBuilderInterface;

    /**
     * Adds a new argument to the command with a name and a description.
     *
     * The order of the arguments descriptions defines the order of the expected arguments.
     *
     * @throws RuntimeException When an argument with the name is already described or any command is described.
     */
    public function describeArgument(string $name, string $description): ConsoleArgumentBuilderInterface;

    /**
     * Adds a new option to the exec task which will be available independent of the concrete command.
     *
     * @param string $name        The option name.
     * @param string $description The option description.
     *
     * @throws RuntimeException When an option with the name is already described.
     */
    public function describeOption(string $name, string $description): ConsoleOptionBuilderInterface;
}
