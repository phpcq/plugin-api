<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

/**
 * The stage in which the fix tasks of a plugin are executed.
 */
enum FixStage: string
{
    /** Normalization of project metadata, e.g. composer.json. */
    case Normalize = 'normalize';

    /** Structural changes of the code, e.g. rector. */
    case Refactor = 'refactor';

    /** Pure formatting, always executed last, e.g. phpcbf. */
    case Format = 'format';

    /**
     * The execution order. Lower values are executed first.
     */
    public function order(): int
    {
        return match ($this) {
            self::Normalize => 0,
            self::Refactor  => 1,
            self::Format    => 2,
        };
    }
}
