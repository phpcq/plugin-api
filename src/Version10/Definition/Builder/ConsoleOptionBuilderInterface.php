<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Definition\Builder;

/**
 * This interface describes a command option.
 */
interface ConsoleOptionBuilderInterface
{
    public const VALUE_SEPARATOR_SPACE = ' ';

    public const VALUE_SEPARATOR_EQUAL_SIGN = '=';

    public const VALUE_SEPARATOR_NONE = '';

    /**
     * Mark the option as required. If not defined the option is considered as optional.
     *
     * @return self
     */
    public function isRequired(): self;

    /**
     * Mark the option as an array if the option may occur multiple times.
     *
     * @return self
     */
    public function isArray(): self;

    /**
     * Declare that a value is required for this option.
     *
     * You may only declare a value as required or optional.
     *
     * @param string|null $name The name of the optional value.
     *
     * @return self
     */
    public function withRequiredValue(?string $name = null): self;

    /**
     * Declare a shortcut which may be used as an alias for the option.
     *
     * @return $this
     */
    public function withShortcut(string $shortcut): self;

    /**
     * Use the name as shortcut and do not provide a full name option like --name, instead -name is available.
     *
     * @return $this
     */
    public function withShortcutOnly(): self;

    /**
     * Declare that a value is optional for this option. A default value may be defined also.
     *
     * You may only declare a value as required or optional. If your option supports multiple named values you're able
     * to define each of them (e.g. --init [source_dir=src] [level=3]).
     *
     * @param string|null $name         The name of the optional value.
     * @param mixed       $defaultValue The default value.
     *
     * @return self
     */
    public function withOptionalValue(?string $name = null, $defaultValue = null): self;

    /**
     * The option may contain a key value map.
     *
     * Example php -d memory_limit=1
     *
     * @param mixed       $defaultValue   An optional default value if no value is provided.
     * @param string|null $valueSeparator Used value separator. If empty an equal sign is assumed.
     *
     * @return self
     */
    public function withKeyValueMap($defaultValue = null, ?string $valueSeparator = null): self;

    /**
     * Overrides the console application setting for the option values separator.
     *
     * If not defined, PHPCQ assumes that only an equal sign is used.
     *
     * @param string $separator The char used to separate option value from the option name.
     *
     * @return mixed
     */
    public function withOptionValueSeparator(string $separator): self;
}
