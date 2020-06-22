<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes a list option of same values.
 */
interface ListOptionBuilderInterface extends OptionBuilderInterface
{
    /**
     * Declare list of string items.
     */
    public function ofStringItems(): StringOptionBuilderInterface;

    /**
     * Declare list of float items.
     */
    public function ofFloatItems(): FloatOptionBuilderInterface;

    /**
     * Declare list of integer items.
     */
    public function ofIntItems(): IntOptionBuilderInterface;

    /**
     * Declare a list of object like items.
     *
     * @return OptionsBuilderInterface
     */
    public function ofOptionsItems(): OptionsBuilderInterface;

    /**
     * Define a default value.
     *
     * The default value is used then no value is configured.
     *
     * @return $this
     */
    public function withDefaultValue(array $defaultValue): self;
}
