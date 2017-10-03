<?php
namespace Corp104\Taiwan\Bank;

class SmokeTest extends \PHPUnit_Framework_TestCase
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
