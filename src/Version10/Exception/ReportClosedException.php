<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Exception;

class ReportClosedException extends RuntimeException
{
    /**
     * Create a new instance.
     */
    public function __construct()
    {
        parent::__construct('Report has already been closed');
    }
}
