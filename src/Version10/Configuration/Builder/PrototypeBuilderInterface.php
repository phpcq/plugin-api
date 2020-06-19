<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

interface PrototypeBuilderInterface extends OptionBuilderInterface
{
    /**
     * Declare a list of object like items.
     *
     * @return OptionsBuilderInterface
     * @psalm-return OptionsBuilderInterface<ListOptionBuilderInterface>
     */
    public function ofArrayValue() : OptionsBuilderInterface;

    /**
     * Define a bool prototype value.
     *
     * @return $this
     */
    public function ofBoolValue() : self;

    /**
     * Define an enum prototype value.
     *
     * @return EnumOptionBuilderInterface
     */
    public function ofEnumValue(): EnumOptionBuilderInterface;

    /**
     * Define a float prototype value.
     *
     * @return $this
     */
    public function ofFloatValue(): self;

    /**
     * Define an integer prototype value.
     *
     * @return $this
     */
    public function ofIntValue(): self;

    /**
     * Define a list prototype value.
     *
     * @return ListOptionBuilderInterface
     */
    public function ofListValue(): ListOptionBuilderInterface;

    /**
     * Define a string prototype value.
     *
     * @return $this
     */
    public function ofStringValue() : self;

    /**
     * Define a prototype vale.
     *
     * @return PrototypeBuilderInterface
     */
    public function ofPrototypeValue(): PrototypeBuilderInterface;
}