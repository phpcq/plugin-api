<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMDocument;
use DOMElement;
use DOMNode;

use Phpcq\PluginApi\Version10\PostProcessorInterface;
use Phpcq\PluginApi\Version10\ToolReportInterface;
use function strlen;
use function strpos;
use function substr;

/**
 * Helper class to handle checkstyle log files.
 *
 * Provides static reading of the log and usage as post processor.
 */
class CheckstyleReportAppender implements PostProcessorInterface
{
    use XmlReportAppenderTrait;

    /** @SuppressWarnings(PHPMD.UnusedPrivateMethod) */
    private function processXml(ToolReportInterface $report): void
    {
        $xmlDocument = new DOMDocument('1.0');
        $xmlDocument->load($this->fileName);
        $rootNode = $xmlDocument->firstChild;

        if (!$rootNode instanceof DOMNode) {
            return;
        }

        foreach ($rootNode->childNodes as $childNode) {
            if (!$childNode instanceof DOMElement) {
                continue;
            }

            $fileName = $childNode->getAttribute('name');
            if (strpos($fileName, $this->rootDir) === 0) {
                $fileName = substr($fileName, strlen($this->rootDir) + 1);
            }

            foreach ($childNode->childNodes as $errorNode) {
                if (!$errorNode instanceof DOMElement) {
                    continue;
                }

                /** @psalm-suppress PossiblyNullArgument */
                $report->addDiagnostic(
                    self::getXmlAttribute($errorNode, 'severity', 'error'),
                    self::getXmlAttribute($errorNode, 'message', ''),
                    $fileName,
                    self::getIntXmlAttribute($errorNode, 'line'),
                    self::getIntXmlAttribute($errorNode, 'column'),
                    self::getXmlAttribute($errorNode, 'source')
                );
            }
        }
    }
}