<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMElement;
use Phpcq\PluginApi\Version10\OutputTransformerFactoryInterface;
use Phpcq\PluginApi\Version10\OutputTransformerInterface;
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

    public static function transform(string $fileName, string $rootDir): OutputTransformerFactoryInterface
    {
        return new class (static::class, $fileName, $rootDir) implements OutputTransformerFactoryInterface {
            /** @var XmlReportAppenderTrait */
            private $calledClass;
            /** @var string */
            private $fileName;
            /** @var string */
            private $rootDir;

            public function __construct(string $calledClass, string $fileName, string $rootDir)
            {
                $this->calledClass = $calledClass;
                $this->fileName    = $fileName;
                $this->rootDir     = $rootDir;
            }

            public function createFor(ToolReportInterface $report): OutputTransformerInterface
            {
                return new class (
                    $this->calledClass,
                    $this->fileName,
                    $this->rootDir,
                    $report
                ) implements OutputTransformerInterface {
                    /** @var XmlReportAppenderTrait */
                    private $calledClass;
                    /** @var string */
                    private $fileName;
                    /** @var string */
                    private $rootDir;
                    /** @var ToolReportInterface */
                    private $report;

                    public function __construct(
                        string $calledClass,
                        string $fileName,
                        string $rootDir,
                        ToolReportInterface $report
                    ) {
                        $this->calledClass = $calledClass;
                        $this->fileName    = $fileName;
                        $this->rootDir     = $rootDir;
                        $this->report      = $report;
                    }

                    public function write(string $data, int $channel): void
                    {
                        // No op in here.
                    }

                    public function finish(int $exitCode): void
                    {
                        $this->calledClass::appendTo($this->report, $this->fileName, $this->rootDir);
                        $this->report->finish(
                            $exitCode === 0 ? ToolReportInterface::STATUS_PASSED : ToolReportInterface::STATUS_FAILED
                        );
                    }
                };
            }
        };
    }

    public static function appendTo(ToolReportInterface $report, string $fileName, string $rootDir): void
    {
        $instance = new self($fileName, $rootDir);
        $instance->processXml($report);
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