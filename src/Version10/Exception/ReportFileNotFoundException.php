<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Exception;

class ReportFileNotFoundException extends RuntimeException
{
    /** @var string */
    private $fileName;

    public function __construct(string $fileName)
    {
        parent::__construct('Report file not found: ' . $fileName);

        $this->fileName = $fileName;
    }

    /** Obtain the file that could not be found */
    public function getFileName(): string
    {
        return $this->fileName;
    }
}
