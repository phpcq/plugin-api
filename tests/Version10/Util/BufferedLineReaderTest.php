<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10\Util;

use Phpcq\PluginApi\Version10\Util\BufferedLineReader;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader
 */
final class BufferedLineReaderTest extends TestCase
{
    public function testReadFromEmptyIsNull(): void
    {
        $buffer = new BufferedLineReader();

        $this->assertNull($buffer->fetch());
    }

    public function testReadFromIncompleteLineIsNull(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push('abc');
        $this->assertNull($buffer->fetch());
    }

    public function testReadFromCompleteLineIsSuccessfulSubsequentFetchReturnsNull(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push('abc' . "\n");
        $this->assertSame('abc', $buffer->fetch());
        $this->assertNull($buffer->fetch());
    }

    public function testReadsMultipleLines(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push("abc\ndef\nghi\n");
        $this->assertSame('abc', $buffer->fetch());
        $this->assertSame('def', $buffer->fetch());
        $this->assertSame('ghi', $buffer->fetch());
        $this->assertNull($buffer->fetch());
    }

    public function testReadsMultipleLinesTrimmed(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push("  abc  \ndef  \n ghi\n");
        $this->assertSame('abc', $buffer->fetch());
        $this->assertSame('def', $buffer->fetch());
        $this->assertSame('ghi', $buffer->fetch());
        $this->assertNull($buffer->fetch());
    }

    public function testReadsMultipleLinesUntrimmed(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push("  abc  \ndef  \n ghi\n");
        $this->assertSame('  abc  ', $buffer->fetch(false));
        $this->assertSame('def  ', $buffer->fetch(false));
        $this->assertSame(' ghi', $buffer->fetch(false));
        $this->assertNull($buffer->fetch(false));
    }

    public function testPeekIntoEmptyIsNull(): void
    {
        $buffer = new BufferedLineReader();

        $this->assertNull($buffer->peek());
    }

    public function testPeekIntoIncompleteLineIsNull(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push('abc');
        $this->assertNull($buffer->peek());
    }

    public function testPeekIntoCompleteLineIsSuccessfulSubsequentFetchesSameString(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push('abc' . "\n");
        $this->assertSame('abc', $buffer->peek());
        $this->assertSame('abc', $buffer->peek());
    }

    public function testPeekTrims(): void
    {
        $buffer = new BufferedLineReader();

        $buffer->push("  abc  \n");
        $this->assertSame('abc', $buffer->peek());
    }
}
