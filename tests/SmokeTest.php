<?php
namespace Tests;

use Corp104\Taiwan\Bank\Factory;
use Corp104\Taiwan\Bank\BankCollection;
use PHPUnit\Framework\TestCase;

class SmokeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeOkayWhenSmokeTest()
    {
        $target = Factory::create();

        $this->assertInstanceOf(BankCollection::class, $target);
    }
}
