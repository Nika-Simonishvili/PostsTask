<?php

namespace App\Traits;

use PHPUnit\Framework\Assert;

trait AssertArrayStructureTrait
{
    public function assertHasKeys(array $item): void
    {
        Assert::assertIsArray($item);
        Assert::assertArrayHasKey('userId', $item);
        Assert::assertArrayHasKey('title', $item);
        Assert::assertArrayHasKey('body', $item);
    }
}