<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use PHPUnit\Framework\TestCase;

class SmokeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeOkayWhenSmokeTest()
    {
        $target = new Bank();

        $this->assertInstanceOf(Bank::class, $target);
    }
}
