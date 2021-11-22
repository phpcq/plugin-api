<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes a console application provided by a plugin.
 */
interface ConsoleApplicationBuilderInterface
{
    /**
     * Adds a description to the console application.
     *
     * @param string $description The description of the console application
     *
     * @return self
     */
    public function withDescription(string $description): self;

    /**
     * Describe which value separators are supported.
     *
     * If not defined, PHPCQ assumes that only an equal sign is used.
     *
     * @param list<string> $separators
     *
     * @return mixed
     */
    public function withOptionValueSeparators(string ... $separators): self;

    /**
     * Adds a new command to the console application.
     *
     * @param string $name        The command name.
     * @param string $description The command description.
     *
     * @return ConsoleCommandBuilderInterface
     */
    public function describeCommand(string $name, string $description): ConsoleCommandBuilderInterface;

    /**
     * Adds a new option to the exec task which will be available independent of the concrete command.
     *
     * @param string $name        The option name.
     * @param string $description The option description.
     */
    public function describeOption(string $name, string $description): ConsoleOptionBuilderInterface;
}
