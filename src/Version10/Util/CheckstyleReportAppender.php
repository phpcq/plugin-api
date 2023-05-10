<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMElement;
use DOMNode;
use Phpcq\PluginApi\Version10\Report\TaskReportInterface;

use function strlen;
use function strpos;
use function substr;

/**
 * Helper class to handle checkstyle log files.
 *
 * Provides static reading of the log and usage as post processor.
 *
 *  @psalm-type TDiagnosticSeverity = TaskReportInterface::SEVERITY_NONE|
 * TaskReportInterface::SEVERITY_INFO|
 * TaskReportInterface::SEVERITY_MARGINAL|
 * TaskReportInterface::SEVERITY_MINOR|
 * TaskReportInterface::SEVERITY_MAJOR|
 * TaskReportInterface::SEVERITY_FATAL
 */
final class CheckstyleReportAppender implements XmlReportAppenderInterface
{
    use XmlReportAppenderTrait;

    // TODO: Check if mapping makes sense
    private const SEVERITY_MAP = [
        'error'   => TaskReportInterface::SEVERITY_MAJOR,
        'warning' => TaskReportInterface::SEVERITY_MINOR,
        'info'    => TaskReportInterface::SEVERITY_MARGINAL,
        'ignore'  => TaskReportInterface::SEVERITY_INFO,
    ];

    protected function processXml(TaskReportInterface $report): void
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
                        $this->getSeverity($errorNode),
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

    /** @psalm-return TDiagnosticSeverity */
    private function getSeverity(DOMElement $errorNode): string
    {
        $errorType = $this->getXmlAttribute($errorNode, 'severity', 'error');

        return self::SEVERITY_MAP[$errorType] ?? TaskReportInterface::SEVERITY_MAJOR;
    }
}
