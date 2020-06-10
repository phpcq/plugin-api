<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMElement;
use DOMNode;
use Phpcq\PluginApi\Version10\Report\ToolReportInterface;

use function strlen;
use function strpos;
use function substr;

/**
 * Helper class to handle checkstyle log files.
 *
 * Provides static reading of the log and usage as post processor.
 */
final class CheckstyleReportAppender implements XmlReportAppenderInterface
{
    use XmlReportAppenderTrait;

    protected function processXml(ToolReportInterface $report): void
    {
        $rootNode = $this->xmlDocument->firstChild;

        if (!$rootNode instanceof DOMNode) {
            return;
        }

        foreach ($rootNode->childNodes as $childNode) {
            if (!$childNode instanceof DOMElement) {
                continue;
            }

            $fileName = $childNode->getAttribute('name');
            if (strpos($fileName, $this->rootDir) === 0) {
                $fileName = substr($fileName, strlen($this->rootDir));
            }

            foreach ($childNode->childNodes as $errorNode) {
                if (!$errorNode instanceof DOMElement) {
                    continue;
                }

                $builder = $report
                    ->addDiagnostic(
                        (string) $this->getXmlAttribute($errorNode, 'severity', 'error'),
                        (string) $this->getXmlAttribute($errorNode, 'message', '')
                    )
                    ->forFile($fileName)
                        ->forRange(
                            (int) $this->getIntXmlAttribute($errorNode, 'line'),
                            $this->getIntXmlAttribute($errorNode, 'column')
                        )
                        ->end();
                if ($source = $this->getXmlAttribute($errorNode, 'source')) {
                    $builder->fromSource($source);
                }
                $builder->end();
            }
        }
    }
}
