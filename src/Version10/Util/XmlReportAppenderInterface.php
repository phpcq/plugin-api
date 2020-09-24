<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use Phpcq\PluginApi\Version10\Output\OutputTransformerFactoryInterface;
use Phpcq\PluginApi\Version10\Report\TaskReportInterface;

interface XmlReportAppenderInterface
{
    public static function transformBuffer(string $rootDir): OutputTransformerFactoryInterface;

    public static function transformFile(string $fileName, string $rootDir): OutputTransformerFactoryInterface;

    public static function appendFileTo(TaskReportInterface $report, string $fileName, string $rootDir): void;

    public static function appendBufferTo(TaskReportInterface $report, string $buffer, string $rootDir): void;
}
