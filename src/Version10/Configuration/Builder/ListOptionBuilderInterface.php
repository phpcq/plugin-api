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
    public function ofStringItems(): StringListOptionBuilderInterface;

    /**
     * Declare a list of object like items.
     */
    public function ofOptionsItems(): OptionsListBuilderInterface;
}
