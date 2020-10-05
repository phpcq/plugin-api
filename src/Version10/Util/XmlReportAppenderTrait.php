<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMDocument;
use DOMElement;
use Phpcq\PluginApi\Version10\Exception\ReportFileNotFoundException;
use Phpcq\PluginApi\Version10\Output\OutputInterface;
use Phpcq\PluginApi\Version10\Output\OutputTransformerFactoryInterface;
use Phpcq\PluginApi\Version10\Output\OutputTransformerInterface;
use Phpcq\PluginApi\Version10\Report\TaskReportInterface;

trait XmlReportAppenderTrait
{
    /**
     * The source xml document being appended to the report.
     *
     * @var DOMDocument
     */
    private $xmlDocument;

    /**
     * @var string
     */
    private $rootDir;

    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public static function transformBuffer(string $rootDir): OutputTransformerFactoryInterface
    {
        return new class (static::class, $rootDir) implements OutputTransformerFactoryInterface {
            /**
             * @psalm-var class-string<XmlReportAppenderInterface>
             * @var string
             */
            private $calledClass;
            /** @var string */
            private $rootDir;

            /**
             * @psalm-param class-string<XmlReportAppenderInterface> $calledClass
             */
            public function __construct(string $calledClass, string $rootDir)
            {
                $this->calledClass = $calledClass;
                $this->rootDir     = $rootDir;
            }

            public function createFor(TaskReportInterface $report): OutputTransformerInterface
            {
                return new class (
                    $this->calledClass,
                    $this->rootDir,
                    $report
                ) implements OutputTransformerInterface {
                    /**
                     * @psalm-var class-string<XmlReportAppenderInterface>
                     * @var string
                     */
                    private $calledClass;
                    /** @var string */
                    private $buffer = '';
                    /** @var string */
                    private $rootDir;
                    /** @var TaskReportInterface */
                    private $report;

                    /**
                     * @psalm-param class-string<XmlReportAppenderInterface> $calledClass
                     */
                    public function __construct(
                        string $calledClass,
                        string $rootDir,
                        TaskReportInterface $report
                    ) {
                        $this->calledClass = $calledClass;
                        $this->rootDir     = $rootDir;
                        $this->report      = $report;
                    }

                    public function write(string $data, int $channel): void
                    {
                        if (OutputInterface::CHANNEL_STDOUT === $channel) {
                            $this->buffer .= $data;
                        }
                    }

                    public function finish(int $exitCode): void
                    {
                        $this->calledClass::appendBufferTo($this->report, $this->buffer, $this->rootDir);
                        $this->report->close(
                            $exitCode === 0 ? TaskReportInterface::STATUS_PASSED : TaskReportInterface::STATUS_FAILED
                        );
                    }
                };
            }
        };
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public static function transformFile(string $fileName, string $rootDir): OutputTransformerFactoryInterface
    {
        return new class (static::class, $fileName, $rootDir) implements OutputTransformerFactoryInterface {
            /**
             * @psalm-var class-string<XmlReportAppenderInterface>
             * @var string
             */
            private $calledClass;
            /** @var string */
            private $fileName;
            /** @var string */
            private $rootDir;

            /**
             * @psalm-param class-string<XmlReportAppenderInterface> $calledClass
             */
            public function __construct(string $calledClass, string $fileName, string $rootDir)
            {
                $this->calledClass = $calledClass;
                $this->fileName    = $fileName;
                $this->rootDir     = $rootDir;
            }

            public function createFor(TaskReportInterface $report): OutputTransformerInterface
            {
                return new class (
                    $this->calledClass,
                    $this->fileName,
                    $this->rootDir,
                    $report
                ) implements OutputTransformerInterface {
                    /**
                     * @psalm-var class-string<XmlReportAppenderInterface> $calledClass
                     */
                    private $calledClass;
                    /** @var string */
                    private $fileName;
                    /** @var string */
                    private $rootDir;
                    /** @var TaskReportInterface */
                    private $report;
                    /** @var BufferedLineReader */
                    private $stdOut;
                    /** @var BufferedLineReader */
                    private $stdErr;

                    /**
                     * @psalm-param class-string<XmlReportAppenderInterface> $calledClass
                     */
                    public function __construct(
                        string $calledClass,
                        string $fileName,
                        string $rootDir,
                        TaskReportInterface $report
                    ) {
                        $this->calledClass = $calledClass;
                        $this->fileName    = $fileName;
                        $this->rootDir     = $rootDir;
                        $this->report      = $report;
                        $this->stdOut      = BufferedLineReader::create();
                        $this->stdErr      = BufferedLineReader::create();
                    }

                    public function write(string $data, int $channel): void
                    {
                        if (OutputInterface::CHANNEL_STDERR === $channel) {
                            $this->stdErr->push($data);
                            return;
                        }
                        $this->stdOut->push($data);
                    }

                    public function finish(int $exitCode): void
                    {
                        $this->calledClass::appendFileTo($this->report, $this->fileName, $this->rootDir);
                        if ($exitCode !== 0) {
                            $contents = [];
                            while (null !== $line = $this->stdOut->fetch()) {
                                $contents[] = $line;
                            }
                            $this->report
                                ->addAttachment('output.log')
                                ->fromString(implode("\n", $contents))
                                ->setMimeType('text/plain')
                                ->end();
                            $contents = [];
                            while (null !== $line = $this->stdErr->fetch()) {
                                $contents[] = $line;
                            }
                            $this->report
                                ->addAttachment('error.log')
                                ->fromString(implode("\n", $contents))
                                ->setMimeType('text/plain')
                                ->end();
                        }
                        $this->report->close(
                            $exitCode === 0 ? TaskReportInterface::STATUS_PASSED : TaskReportInterface::STATUS_FAILED
                        );
                    }
                };
            }
        };
    }

    public static function appendFileTo(TaskReportInterface $report, string $fileName, string $rootDir): void
    {
        $xmlDocument = new DOMDocument('1.0');
        if (!is_readable($fileName)) {
            throw new ReportFileNotFoundException($fileName);
        }
        $xmlDocument->load($fileName);

        $instance = new self($xmlDocument, $rootDir);
        $instance->processXml($report);
    }

    public static function appendBufferTo(TaskReportInterface $report, string $buffer, string $rootDir): void
    {
        $xmlDocument = new DOMDocument('1.0');
        $xmlDocument->loadXML($buffer);

        $instance = new self($xmlDocument, $rootDir);
        $instance->processXml($report);
    }

    private function __construct(DOMDocument $xmlDocument, string $rootDir)
    {
        $this->xmlDocument = $xmlDocument;
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

    abstract protected function processXml(TaskReportInterface $report): void;
}
