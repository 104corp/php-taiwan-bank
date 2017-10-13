<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use Corp104\Taiwan\Bank\Branch;
use Corp104\Taiwan\Bank\BranchCollection;
use Corp104\Taiwan\Bank\Contact;
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
        $contact = new Contact('', '');
        $bank = new Bank('004', '', '', $contact, '', new BranchCollection(), true, '');
        $branch0040037 = new Branch($bank, '0040037', '', '', $contact, true, '');
        $branch0040059 = new Branch($bank, '0040059', '', '', $contact, true, '');

        $target = $this->buildCollection([$branch0040037->getCode() => $branch0040037]);

        $this->assertCount(1, $target);

        $target->add($branch0040059);

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
