<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

use RuntimeException;

class ReportClosedException extends RuntimeException implements Exception
{
    /**
     * Create a new instance.
     */
    public function __construct()
    {
        parent::__construct('Report has already been closed');
    }
}
