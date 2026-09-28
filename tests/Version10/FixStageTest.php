<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Test\Version10;

use Phpcq\PluginApi\Version10\FixStage;
use PHPUnit\Framework\TestCase;

use function array_map;
use function usort;

/** @covers \Phpcq\PluginApi\Version10\FixStage */
final class FixStageTest extends TestCase
{
    public function testBackingValues(): void
    {
        self::assertSame(FixStage::Normalize, FixStage::from('normalize'));
        self::assertSame(FixStage::Refactor, FixStage::from('refactor'));
        self::assertSame(FixStage::Format, FixStage::from('format'));
        self::assertNull(FixStage::tryFrom('unknown'));
    }

    public function testOrderSortsNormalizeRefactorFormat(): void
    {
        $stages = [FixStage::Format, FixStage::Normalize, FixStage::Refactor];
        usort($stages, static fn (FixStage $first, FixStage $second): int => $first->order() <=> $second->order());

        self::assertSame(
            ['normalize', 'refactor', 'format'],
            array_map(static fn (FixStage $stage): string => $stage->value, $stages)
        );
    }
}
