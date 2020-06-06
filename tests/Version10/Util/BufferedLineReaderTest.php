<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10\Util;

use Phpcq\PluginApi\Version10\Util\BufferedLineReader;
use PHPUnit\Framework\TestCase;

/** @SuppressWarnings(PHPMD.TooManyPublicMethods) */
final class BufferedLineReaderTest extends TestCase
{
    /**
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::__construct()
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::create()
     */
    public function testStaticMethodCreateReturnsEmptyInstance(): void
    {
        $buffer = BufferedLineReader::create();
        $this->assertInstanceOf(BufferedLineReader::class, $buffer);
        $this->assertSame(0, $buffer->getLength());
    }

    /**
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::__construct()
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::createFromString()
     */
    public function testStaticMethodCreateFromStringReturnsInstance(): void
    {
        $buffer = BufferedLineReader::createFromString('abc');
        $this->assertSame(3, $buffer->getLength());
    }

    public function getDataProvider(): array
    {
        return [
            'should return empty string for empty buffer' => [
                'expected' => '',
                'data'     => '',
                'cursor'   => 0,
            ],
            'should return entire buffered string for non empty buffer' => [
                'expected' => 'abc',
                'data'     => 'abc',
                'cursor'   => 0,
            ],
            'should return entire buffered string non empty, partial read buffer' => [
                'expected' => 'abc',
                'data'     => 'abc',
                'cursor'   => 2,
            ],
        ];
    }

    /**
     * @dataProvider getDataProvider
     * @covers       \Phpcq\PluginApi\Version10\Util\BufferedLineReader::getData()
     */
    public function testGetData(?string $expected, ?string $data, int $cursorPos): void
    {
        $buffer = $this->buildBuffer($data, $cursorPos);

        $this->assertSame($expected, $buffer->getData());
    }

    public function pushProvider(): array
    {
        return [
            'should keep empty buffer untouched for empty string' => [
                'expected'  => '',
                'buffer'    => '',
                'cursorPos' => 0,
                'data'      => ''
            ],
            'should keep non empty buffer untouched for empty string' => [
                'expected'  => 'abc',
                'buffer'    => 'abc',
                'cursorPos' => 0,
                'data'      => ''
            ],
            'should add string to empty buffer' => [
                'expected'  => 'abc',
                'buffer'    => '',
                'cursorPos' => 0,
                'data'      => 'abc'
            ],
            'should add string to non empty buffer' => [
                'expected'  => 'abcdef',
                'buffer'    => 'abc',
                'cursorPos' => 0,
                'data'      => 'def'
            ],
        ];
    }

    /**
     * @dataProvider pushProvider
     * @covers       \Phpcq\PluginApi\Version10\Util\BufferedLineReader::push()
     */
    public function testCanPushDataIntoBuffer(string $expected, string $bufferData, int $cursorPos, string $data): void
    {
        $buffer = $this->buildBuffer($bufferData, $cursorPos);
        $buffer->push($data);
        $this->assertSame($expected, $buffer->getData());
        $this->assertSame($cursorPos, $buffer->getCursorPos());
        $this->assertSame(strlen($expected), $buffer->getLength());
    }

    public function getLengthProvider(): array
    {
        return [
            'should return zero for empty buffer' => [
                'expected' => 0,
                'data'     => '',
                'cursor'   => 0,
            ],
            'should return length of entire buffered string for non empty buffer' => [
                'expected' => 3,
                'data'     => 'abc',
                'cursor'   => 0,
            ],
            'should return length of entire buffered string for non empty, partial read buffer' => [
                'expected' => 3,
                'data'     => 'abc',
                'cursor'   => 2,
            ],
        ];
    }

    /**
     * @dataProvider getLengthProvider
     * @covers       \Phpcq\PluginApi\Version10\Util\BufferedLineReader::getLength()
     */
    public function testGetLength(?int $expected, ?string $data, int $cursorPos): void
    {
        $buffer = $this->buildBuffer($data, $cursorPos);

        $this->assertSame($expected, $buffer->getLength());
    }

    /** @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::isEmpty() */
    public function testIsEmpty(): void
    {
        $this->assertTrue($this->buildBuffer(null, 0)->isEmpty());
        $this->assertFalse($this->buildBuffer('abc', 0)->isEmpty());
        $this->assertFalse($this->buildBuffer('abc', 1)->isEmpty());
    }

    /**
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::getCursorPos()
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::getRemainingBytes()
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::isEOF()
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::setCursorPos()
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::clamp()
     */
    public function testCanSetCursorPosition(): void
    {
        $buffer = $this->buildBuffer('abcdef', 0);

        $this->assertSame(0, $buffer->getCursorPos(), 'Should be 0 initially');
        $this->assertSame(6, $buffer->getRemainingBytes(), 'Should be 6 initially');
        $this->assertFalse($buffer->isEOF());
        $buffer->setCursorPos(1);
        $this->assertSame(1, $buffer->getCursorPos(), 'Should be 1 after setting it');
        $this->assertSame(5, $buffer->getRemainingBytes(), 'Should be 5 after setting it');
        $this->assertFalse($buffer->isEOF());
        $buffer->setCursorPos(0);
        $this->assertSame(0, $buffer->getCursorPos(), 'Should be back to 0');
        $this->assertSame(6, $buffer->getRemainingBytes(), 'Should be back to 6');
        $this->assertFalse($buffer->isEOF());
        $buffer->setCursorPos(10);
        $this->assertSame(6, $buffer->getCursorPos(), 'Should be clamped to 6 when exceeding');
        $this->assertSame(0, $buffer->getRemainingBytes(), 'Should be clamped to 0 when exceeding');
        $this->assertTrue($buffer->isEOF());
        $buffer->setCursorPos(-10);
        $this->assertSame(0, $buffer->getCursorPos(), 'Should be clamped to 0 when too low');
        $this->assertSame(6, $buffer->getRemainingBytes(), 'Should be clamped to 6 when too low');
        $this->assertFalse($buffer->isEOF());
    }

    /**
     * @covers \Phpcq\PluginApi\Version10\Util\BufferedLineReader::move()
     */
    public function testCanMoveCursorRelative(): void
    {
        $buffer = $this->buildBuffer('abcdef', 0);
        $buffer->move(1);
        $this->assertSame(1, $buffer->getCursorPos(), 'Should be 1 after moving one byte');
        $buffer->move(0);
        $this->assertSame(1, $buffer->getCursorPos(), 'Should be still at 1');
        $buffer->move(10);
        $this->assertSame(6, $buffer->getCursorPos(), 'Should be clamped to 6 when exceeding');
        $buffer->move(-10);
        $this->assertSame(0, $buffer->getCursorPos(), 'Should be clamped to 0 when too low');
    }

    public function locateProvider(): array
    {
        return [
            'should return null for empty buffer' => [
                'expected'  => null,
                'buffer'    => '',
                'cursorPos' => 0,
                'search'    => "\n"
            ],
            'should return null if not found in non empty buffer' => [
                'expected'  => null,
                'buffer'    => 'abc',
                'cursorPos' => 0,
                'search'    => "\n"
            ],
            'should return null if search string is longer than remaining contents' => [
                'expected'  => null,
                'buffer'    => 'abc',
                'cursorPos' => 0,
                'search'    => "too-long-to-search"
            ],
            'should return correct delta when found in non empty buffer' => [
                'expected'  => 3,
                'buffer'    => "abc\n",
                'cursorPos' => 0,
                'search'    => "\n"
            ],
            'should return correct delta if found in partial read buffer' => [
                'expected'  => 1,
                'buffer'    => "abc\n",
                'cursorPos' => 2,
                'search'    => "\n"
            ],
        ];
    }

    /**
     * @dataProvider locateProvider
     * @covers       \Phpcq\PluginApi\Version10\Util\BufferedLineReader::locate()
     */
    public function testMethodLocateReturnsCorrectResults(
        ?int $expected,
        ?string $data,
        int $cursorPos,
        string $search
    ): void {
        $buffer = $this->buildBuffer($data, $cursorPos);

        $this->assertSame($expected, $buffer->locate($search));
        $this->assertSame($cursorPos, $buffer->getCursorPos(), 'Locate should not move cursor');
    }

    public function fetchProvider(): array
    {
        return [
            'should return null when fetching from empty buffer' => [
                'expectedResult' => null,
                'expectedCursorAfter' => 0,
                'data' => '',
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return null when fetching from buffer with incomplete line' => [
                'expectedResult' => null,
                'expectedCursorAfter' => 0,
                'data' => 'abc',
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return line when fetching from buffer with complete line' => [
                'expectedResult' => 'abc',
                'expectedCursorAfter' => 4,
                'data' => 'abc' . "\n",
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return null when fetching from buffer with complete line but it has already been read' => [
                'expectedResult' => null,
                'expectedCursorAfter' => 4,
                'data' => 'abc' . "\n",
                'cursorPos' => 4,
                'trimmed' => false,
            ],
            'should return second line when fetching from buffer with already read complete line' => [
                'expectedResult' => 'def',
                'expectedCursorAfter' => 8,
                'data' => "abc\ndef\nghi\n",
                'cursorPos' => 4,
                'trimmed' => false,
            ],
            'should return second line untrimmed' => [
                'expectedResult' => '    def    ',
                'expectedCursorAfter' => 16,
                'data' => "abc\n    def    \nghi\n",
                'cursorPos' => 4,
                'trimmed' => false,
            ],
            'should return null when fetching from empty buffer (trim)' => [
                'expectedResult' => null,
                'expectedCursorAfter' => 0,
                'data' => '',
                'cursorPos' => 0,
                'trimmed' => true,
            ],
            'should return null when fetching from buffer with incomplete line (trim)' => [
                'expectedResult' => null,
                'expectedCursorAfter' => 0,
                'data' => 'abc',
                'cursorPos' => 0,
                'trimmed' => true,
            ],
            'should return line when fetching from buffer with complete line (trim)' => [
                'expectedResult' => 'abc',
                'expectedCursorAfter' => 4,
                'data' => 'abc' . "\n",
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return null when fetching from buffer with complete line but it has already been read (trim)' => [
                'expectedResult' => null,
                'expectedCursorAfter' => 4,
                'data' => 'abc' . "\n",
                'cursorPos' => 4,
                'trimmed' => true,
            ],
            'should return second line when fetching from buffer with already read complete line (trim)' => [
                'expectedResult' => 'def',
                'expectedCursorAfter' => 8,
                'data' => "abc\ndef\nghi\n",
                'cursorPos' => 4,
                'trimmed' => true,
            ],
            'should return second line trimmed' => [
                'expectedResult' => 'def',
                'expectedCursorAfter' => 16,
                'data' => "abc\n    def    \nghi\n",
                'cursorPos' => 4,
                'trimmed' => true,
            ],
        ];
    }

    /**
     * @dataProvider fetchProvider
     * @covers       \Phpcq\PluginApi\Version10\Util\BufferedLineReader::fetch()
     */
    public function testFetch(
        ?string $expectedResult,
        int $expectedCursorAfter,
        string $data,
        int $cursorPos,
        bool $trimmed
    ): void {
        $buffer = $this->buildBuffer($data, $cursorPos);

        $this->assertSame($expectedResult, $buffer->fetch($trimmed));
        $this->assertSame($expectedCursorAfter, $buffer->getCursorPos());
    }

    public function peekProvider(): array
    {
        return [
            'should return null when fetching from empty buffer' => [
                'expectedResult' => null,
                'data' => '',
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return null when fetching from buffer with incomplete line' => [
                'expectedResult' => null,
                'data' => 'abc',
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return line when fetching from buffer with complete line' => [
                'expectedResult' => 'abc',
                'data' => 'abc' . "\n",
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return null when fetching from buffer with complete line but it has already been read' => [
                'expectedResult' => null,
                'data' => 'abc' . "\n",
                'cursorPos' => 4,
                'trimmed' => false,
            ],
            'should return second line when fetching from buffer with already read complete line' => [
                'expectedResult' => 'def',
                'data' => "abc\ndef\nghi\n",
                'cursorPos' => 4,
                'trimmed' => false,
            ],
            'should return second line untrimmed' => [
                'expectedResult' => '    def    ',
                'data' => "abc\n    def    \nghi\n",
                'cursorPos' => 4,
                'trimmed' => false,
            ],
            'should return null when fetching from empty buffer (trim)' => [
                'expectedResult' => null,
                'data' => '',
                'cursorPos' => 0,
                'trimmed' => true,
            ],
            'should return null when fetching from buffer with incomplete line (trim)' => [
                'expectedResult' => null,
                'data' => 'abc',
                'cursorPos' => 0,
                'trimmed' => true,
            ],
            'should return line when fetching from buffer with complete line (trim)' => [
                'expectedResult' => 'abc',
                'data' => 'abc' . "\n",
                'cursorPos' => 0,
                'trimmed' => false,
            ],
            'should return null when fetching from buffer with complete line but it has already been read (trim)' => [
                'expectedResult' => null,
                'data' => 'abc' . "\n",
                'cursorPos' => 4,
                'trimmed' => true,
            ],
            'should return second line when fetching from buffer with already read complete line (trim)' => [
                'expectedResult' => 'def',
                'data' => "abc\ndef\nghi\n",
                'cursorPos' => 4,
                'trimmed' => true,
            ],
            'should return second line trimmed' => [
                'expectedResult' => 'def',
                'data' => "abc\n    def    \nghi\n",
                'cursorPos' => 4,
                'trimmed' => true,
            ],
        ];
    }

    /**
     * @dataProvider peekProvider
     * @covers       \Phpcq\PluginApi\Version10\Util\BufferedLineReader::peek()
     */
    public function testPeek(
        ?string $expectedResult,
        string $data,
        int $cursorPos,
        bool $trimmed
    ): void {
        $buffer = $this->buildBuffer($data, $cursorPos);

        $this->assertSame($expectedResult, $buffer->peek($trimmed));
        $this->assertSame($cursorPos, $buffer->getCursorPos());
    }

    private function buildBuffer(?string $contents, int $cursorPos): BufferedLineReader
    {
        // This could be done better but reflection works best for the moment.
        if (null === $contents) {
            return BufferedLineReader::create();
        }

        $buffer = BufferedLineReader::createFromString($contents);
        $buffer->setCursorPos($cursorPos);

        return $buffer;
    }
}
