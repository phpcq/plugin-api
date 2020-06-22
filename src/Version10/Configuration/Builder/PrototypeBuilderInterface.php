<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface describes an prototype option.
 *
 * A prototype option is an array with string key containing same values. The value has to be explicit described.
 */
interface PrototypeBuilderInterface
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
     */
    public function ofBoolValue() : BoolOptionBuilderInterface;

    /**
     * Define an enum prototype value.
     *
     * @return EnumOptionBuilderInterface
     */
    public function ofEnumValue(): EnumOptionBuilderInterface;

    /**
     * Define a float prototype value.
     */
    public function ofFloatValue(): FloatOptionBuilderInterface;

    /**
     * Define an integer prototype value.
     */
    public function ofIntValue(): IntOptionBuilderInterface;

    /**
     * Define a list prototype value.
     *
     * @return ListOptionBuilderInterface
     */
    public function ofListValue(): ListOptionBuilderInterface;

    /**
     * Define a string prototype value.
     */
    public function ofStringValue() : StringOptionBuilderInterface;

    /**
     * Define a prototype vale.
     *
     * @return PrototypeBuilderInterface
     */
    public function ofPrototypeValue(): PrototypeBuilderInterface;
}
