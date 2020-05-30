<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Util;

use DOMDocument;
use DOMElement;
use DOMNode;

use Phpcq\PluginApi\Version10\PostProcessorInterface;
use Phpcq\PluginApi\Version10\ToolReportInterface;

/**
 * Helper class to handle JUnit log files.
 *
 * Provides static reading of the log and usage as post processor.
 */
class JUnitReportAppender implements PostProcessorInterface
{
    use XmlReportAppenderTrait;

    /** @SuppressWarnings(PHPMD.UnusedPrivateMethod) */
    private function processXml(ToolReportInterface $report): void
    {
        $xmlDocument = new DOMDocument('1.0');
        $xmlDocument->load($this->fileName);
        $rootNode = $xmlDocument->firstChild;

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
         *
         * - name: name of test
         * - class: FQDN of the test class
         * - classname: dot separated FQDN of the class
         * - file: file the test class is declared in (absolute path)
         * - line: line number of failure
         * - assertions: assertion count up until error
         * - time: time test has consumed
         */
        foreach ($testCase->childNodes as $childNode) {
            if (!$childNode instanceof DOMElement) {
                continue;
            }

            switch ($childNode->nodeName) {
                case 'error':
                case 'failure':
                    $severity = ToolReportInterface::SEVERITY_ERROR;
                    break;
                case 'warning':
                    $severity = ToolReportInterface::SEVERITY_WARNING;
                    break;
                default:
                    // FIXME: remove this.
                    throw new \RuntimeException('Node name unknown: ' . $childNode->nodeName);
            }
            /*
             * <failure> has the following attributes:
             * - type: name of exception
             *
             * Text content holds error message.
             */
            $report->addError(
                $severity,
                $this->stripRootDir($childNode->nodeValue),
                $this->stripRootDir($testCase->getAttribute('file')),
                $this->getIntXmlAttribute($testCase, 'line'),
                null,
                $this->getXmlAttribute($childNode, 'type')
            );
        }
    }

    private function stripRootDir(string $content): string
    {
        return str_replace($this->rootDir, '', $content);
    }
}