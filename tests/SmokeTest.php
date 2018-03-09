<?php
namespace Tests;

use Corp104\Taiwan\Bank\Factory;
use Corp104\Taiwan\Bank\BankCollection;
use Corp104\Taiwan\Bank\Resource\OpenDataFromFinancialInformationService;
use PHPUnit\Framework\TestCase;

class SmokeTest extends TestCase
{
    /**
     * @testdox 測試資料來源：銀行局,
     * @test
     */
    public function shouldBeOkayWhenSmokeTestPart1()
    {
        $target = Factory::create();

        $this->assertInstanceOf(BankCollection::class, $target);
    }

    /**
     * @testdox 測試資料來源：民營財金資訊公司,
     * @test
     */
    public function shouldBeOkayWhenSmokeTestPart2()
    {
        $factory = new Factory();

        //取金融卡類目
        $resource = new OpenDataFromFinancialInformationService();
        $factory::setDefaultResource($resource);
        $target = $factory::create();
        $this->assertCount(62, $target);
        $this->assertInstanceOf(BankCollection::class, $target);

        //取網路ATM類目
        $resource = new OpenDataFromFinancialInformationService();
        $resource->setDefaultType(26);
        $factory::setDefaultResource($resource);
        $target = $factory::create();
        $this->assertCount(49, $target);
        $this->assertInstanceOf(BankCollection::class, $target);
    }
}
