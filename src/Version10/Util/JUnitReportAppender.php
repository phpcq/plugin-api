<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMElement;
use DOMNode;
use Phpcq\PluginApi\Version10\ToolReportInterface;

/**
 * Helper class to handle JUnit log files.
 *
 * Provides static reading of the log and usage as post processor.
 *
 * Format: https://github.com/windyroad/JUnit-Schema/blob/master/JUnit.xsd
 * At task: http://svn.apache.org/repos/asf/ant/core/trunk/src/main/org/apache/tools/ant/taskdefs/optional/junit/XMLJUnitResultFormatter.java
 */
final class JUnitReportAppender implements XmlReportAppenderInterface
{
    use XmlReportAppenderTrait;

    protected function processXml(ToolReportInterface $report): void
    {
        $rootNode = $this->xmlDocument->firstChild;

        if (!$rootNode instanceof DOMNode || $rootNode->nodeName !== 'testsuites') {
            return;
        }

        foreach ($rootNode->childNodes as $childNode) {
            if ((!$childNode instanceof DOMElement) || ($childNode->nodeName !== 'testsuite')) {
                continue;
            }
            $this->walkTestSuite($report, $childNode);
        }
    }

    private function walkTestSuite(ToolReportInterface $report, DOMElement $testsuite): void
    {
        foreach ($testsuite->childNodes as $childNode) {
            if (!$childNode instanceof DOMElement) {
                continue;
            }

            switch ($childNode->nodeName) {
                case 'testsuite':
                    // We are only interested in errors.
                    if (!$this->wantToProcessTestSuite($childNode)) {
                        break;
                    }
                    $this->walkTestSuite($report, $childNode);
                    break;
                case 'testcase':
                    $this->walkTestCase($report, $childNode);
            }
        }
    }

    private function wantToProcessTestSuite(DOMElement $testsuite): bool
    {
        // We are only interested in errors, failures and the like.
        if (0 !== $this->getIntXmlAttribute($testsuite, 'errors')) {
            return true;
        }
        if (0 !== $this->getIntXmlAttribute($testsuite, 'failures')) {
            return true;
        }
        if (0 !== $this->getIntXmlAttribute($testsuite, 'warnings')) {
            return true;
        }

        return false;
    }

    private function walkTestCase(ToolReportInterface $report, DOMElement $testCase): void
    {
        /*
         * <testcase> has the following attributes:
         * - name: The name of the test case.
         * - class: The name of the class the test is defined in (FQCN).
         * - classname: The FQCN of the test as "." separated namespace.
         * - file: The name of the file the test is defined within (absolute path).
         * - line: The line in above file, the failed assertion was on.
         * - assertions: The amount of assertions performed (up until error).
         * - time: The duration of the test case.
         */
        foreach ($testCase->childNodes as $childNode) {
            if (!$childNode instanceof DOMElement) {
                continue;
            }

            $severity = $this->getSeverity($childNode);
            if (null === $severity) {
                continue;
            }
            /*
             * For phpunit, the following is true:
             *
             * <$childNode> has the following attributes:
             * - type: name of the exception class or "error type"
             *
             * Text content holds error message.
             */
            $builder = $report
                ->addDiagnostic($severity, $this->stripRootDir((string) $childNode->nodeValue))
                ->forFile($this->stripRootDir((string) $testCase->getAttribute('file')))
                    ->forRange((int) $this->getIntXmlAttribute($testCase, 'line'))
                    ->end();

            if ($source = $this->getXmlAttribute($childNode, 'type')) {
                $builder->fromSource($source);
            }
            $builder->end();
        }
    }

    private function getSeverity(DOMElement $childNode): ?string
    {
        switch ($childNode->nodeName) {
            case 'error':
            case 'failure':
                return ToolReportInterface::SEVERITY_ERROR;
                break;
            case 'warning':
                return ToolReportInterface::SEVERITY_WARNING;
                break;
            case 'skipped':
            case 'system-err':
            case 'system-out':
            default:
                return null;
        }
    }

    private function stripRootDir(string $content): string
    {
        return str_replace($this->rootDir, '', $content);
    }
}
