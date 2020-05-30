<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMElement;
use Phpcq\PluginApi\Version10\OutputInterface;
use Phpcq\PluginApi\Version10\PostProcessorInterface;
use Phpcq\PluginApi\Version10\ToolReportInterface;

trait XmlReportAppenderTrait
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $rootDir;

    public static function postProcess(string $fileName, string $rootDir): PostProcessorInterface
    {
        return new self($fileName, $rootDir);
    }

    public static function appendTo(ToolReportInterface $report, string $fileName, string $rootDir): void
    {
        $instance = new self($fileName, $rootDir);
        $instance->processXml($report);
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function process(ToolReportInterface $report, string $consoleOutput, int $exitCode, OutputInterface $output): void
    {
        $this->processXml($report);
        $report->finish($exitCode === 0 ? ToolReportInterface::STATUS_PASSED : ToolReportInterface::STATUS_FAILED);
    }

    private function __construct(string $fileName, string $rootDir)
    {
        $this->fileName = $fileName;
        if ('/' !== substr($rootDir, -1)) {
            $rootDir .= '/';
        }
        $this->rootDir = $rootDir;
    }

    private function getXmlAttribute(DOMElement $element, string $attribute, ?string $defaultValue = null): ?string
    {
        if ($element->hasAttribute($attribute)) {
            return $element->getAttribute($attribute);
        }

        return $defaultValue;
    }

    private function getIntXmlAttribute(DOMElement $element, string $attribute): ?int
    {
        $value = $this->getXmlAttribute($element, $attribute);
        if ($value === null) {
            return null;
        }

        return (int) $value;
    }
}