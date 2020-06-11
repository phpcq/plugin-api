<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Output;

/**
 * Interface describes the output channel to which a task may write to.
 *
 * @psalm-type TOutputVerbosity = OutputInterface::VERBOSITY_QUIET|OutputInterface::VERBOSITY_NORMAL
 * |OutputInterface::VERBOSITY_VERBOSE|OutputInterface::VERBOSITY_VERY_VERBOSE|OutputInterface::VERBOSITY_DEBUG
 *
 * @psalm-type TOutputChannel = OutputInterface::CHANNEL_STDOUT|OutputInterface::CHANNEL_STDERR
 */
interface OutputInterface
{
    public const VERBOSITY_QUIET = 16;
    public const VERBOSITY_NORMAL = 32;
    public const VERBOSITY_VERBOSE = 64;
    public const VERBOSITY_VERY_VERBOSE = 128;
    public const VERBOSITY_DEBUG = 256;

    public const CHANNEL_STDOUT = 1;
    public const CHANNEL_STDERR = 2;

    /**
     * Write a string without line break.
     *
     * Output is only passed through if defined verbosity level is fulfilled.
     *
     * @psalm-param TOutputVerbosity $verbosity
     * @psalm-param TOutputChannel $channel
     */
    public function write(
        string $message,
        int $verbosity = self::VERBOSITY_NORMAL,
        int $channel = self::CHANNEL_STDOUT
    ): void;

    /**
     * Write a string without line break.
     *
     * Output is only passed through if defined verbosity level is fulfilled.
     *
     * @psalm-param TOutputVerbosity $verbosity
     * @psalm-param TOutputChannel $channel
     */
    public function writeln(
        string $message,
        int $verbosity = self::VERBOSITY_NORMAL,
        int $channel = self::CHANNEL_STDOUT
    ): void;
}
