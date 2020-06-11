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
     *
     * @return $this
     */
    public function ofStringItems(): self;

    /**
     * Declare list of float items.
     *
     * @return $this
     */
    public function ofFloatItems(): self;

    /**
     * Declare list of integer items.
     *
     * @return $this
     */
    public function ofIntItems(): self;
}
