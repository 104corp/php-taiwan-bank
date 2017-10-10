<?php
namespace Tests;

use Corp104\Taiwan\Bank\Branch;
use Corp104\Taiwan\Bank\BranchCollection;
use Tests\Common\CollectionTest;

class BranchCollectionTest extends CollectionTest
{
    protected function buildCollection(array $elements = [])
    {
        return new BranchCollection($elements);
    }

    /**
     * @test
     * @return BranchCollection
     */
    public function shouldIncrementWhenAddBranch()
    {
        $bank004 = (new Branch())
            ->setCode('0040037');
        $bank005 = (new Branch())
            ->setCode('0040059');

        $target = $this->buildCollection([$bank004->getCode() => $bank004]);

        $this->assertCount(1, $target);

        $target->add($bank005);

        $this->assertCount(2, $target);

        return $target;
    }

    /**
     * @test
     * @depends shouldIncrementWhenAddBranch
     * @param BranchCollection $target
     */
    public function shouldBeOkWhenRemoveBank(BranchCollection $target)
    {
        $removed = $target->remove('0040037');

        $this->assertCount(1, $target);
        $this->assertInstanceOf(Branch::class, $removed);
        $this->assertEquals('0040037', $removed->getCode());
    }

    /**
     * @test
     * @depends shouldIncrementWhenAddBranch
     * @param BranchCollection $target
     */
    public function shouldReturnNullWhenRemoveNotExistsBank(BranchCollection $target)
    {
        $this->assertNull($target->remove('0040037'));
    }
}
