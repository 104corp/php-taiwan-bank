<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use Corp104\Taiwan\Bank\BankCollection;
use Corp104\Taiwan\Bank\Contact;
use Corp104\Taiwan\Bank\BranchCollection;
use Tests\Common\CollectionTest;

class BankCollectionTest extends CollectionTest
{
    protected function buildCollection(array $elements = [])
    {
        return new BankCollection($elements);
    }

    /**
     * @test
     * @return BankCollection
     */
    public function shouldIncrementWhenAddBank()
    {
        $bank004 = new Bank('004', '', '', new Contact('', ''), '', new BranchCollection(), true, '');
        $bank005 = new Bank('005', '', '', new Contact('', ''), '', new BranchCollection(), true, '');

        $target = $this->buildCollection([$bank004->getCode() => $bank004]);

        $this->assertCount(1, $target);

        $target->add($bank005);

        $this->assertCount(2, $target);

        return $target;
    }

    /**
     * @test
     * @depends shouldIncrementWhenAddBank
     * @param BankCollection $target
     */
    public function shouldBeOkWhenRemoveBank(BankCollection $target)
    {
        $removed = $target->remove('004');

        $this->assertCount(1, $target);
        $this->assertInstanceOf(Bank::class, $removed);
        $this->assertEquals('004', $removed->getCode());
    }

    /**
     * @test
     * @depends shouldIncrementWhenAddBank
     * @param BankCollection $target
     */
    public function shouldReturnNullWhenRemoveNotExistsBank(BankCollection $target)
    {
        $this->assertNull($target->remove('004'));
    }
}
