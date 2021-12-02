<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Definition\Builder;

/**
 * This interface describes a console command with it's supported arguments and options.
 */
interface ConsoleCommandBuilderInterface
{
    /**
     * Adds a new argument to the command with a name and a description.
     *
     * The order of the arguments descriptions defines the order of the exepected arguments.
     */
    public function describeArgument(string $name, string $description): ConsoleArgumentBuilderInterface;

    /**
     * Adds a new option to the command with a name and a description.
     */
    public function describeOption(string $name, string $description): ConsoleOptionBuilderInterface;
}
