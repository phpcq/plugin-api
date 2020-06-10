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
     * @psalm-param list<string> $defaultValues
     *
     * @return $this
     */
    public function ofStringItems(?array $defaultValues = []): self;

    /**
     * Declare list of float items.
     *
     * @psalm-param list<float> $defaultValues
     *
     * @return $this
     */
    public function ofFloatItems(?array $defaultValues = []): self;

    /**
     * Declare list of integer items.
     *
     * @psalm-param list<int> $defaultValues
     *
     * @return $this
     */
    public function ofIntItems(?array $defaultValues = []): self;

    /**
     * Declare list of array items.
     *
     * @return ArrayOptionsBuilderInterface
     */
    public function ofArrayOptions(): ArrayOptionsBuilderInterface;
}
