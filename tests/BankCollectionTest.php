<?php
namespace Tests;

use Corp104\Taiwan\Bank\BankCollection;
use Corp104\Taiwan\Bank\Bank;
use PHPUnit\Framework\TestCase;

class BankCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCountable()
    {
        $target = new BankCollection(['004' => new Bank()]);

        $this->assertInstanceOf(\Countable::class, $target);
        $this->assertCount(1, $target);
    }

    /**
     * @test
     */
    public function shouldTraversable()
    {
        $target = new BankCollection();

        $this->assertInstanceOf(\Traversable::class, $target);
        $this->assertInstanceOf(\ArrayIterator::class, $target->getIterator());
    }

    /**
     * @test
     */
    public function shouldReturnNullWhenGetNotExistsBank()
    {
        $target = new BankCollection();

        $this->assertNull($target->get('004'));
    }

    /**
     * @test
     * @return BankCollection
     */
    public function shouldIncrementWhenAddBank()
    {
        $bank004 = (new Bank())
            ->setCode('004');
        $bank005 = (new Bank())
            ->setCode('005');

        $target = new BankCollection([$bank004->getCode() => $bank004]);

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
