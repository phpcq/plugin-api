<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Configuration\Builder;

/**
 * Interface ArrayOptionsBuilderInterface describes an array (hash map) of different options.
 */
interface ArrayOptionsBuilderInterface extends OptionsBuilderInterface, OptionBuilderInterface
{
    public function end(): OptionsBuilderInterface;
}
