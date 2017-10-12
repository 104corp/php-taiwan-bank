<?php
namespace Tests\Common;

use Corp104\Taiwan\Bank\Common\Collection;
use Corp104\Taiwan\Bank\Common\Element;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /**
     * @param array $elements
     *
     * @return Collection
     */
    protected function buildCollection(array $elements = [])
    {
        return new Collection($elements);
    }

    /**
     * @return Element[]
     */
    protected function buildDummyElements()
    {
        return [
            'code1' => new DummyElement('code1'),
            'code2' => new DummyElement('code2'),
            'code3' => new DummyElement('code3'),
        ];
    }

    public function testTraversable()
    {
        $collection = $this->buildCollection();

        $this->assertInstanceOf(\Traversable::class, $collection);
        $this->assertInstanceOf(\ArrayIterator::class, $collection->getIterator());
    }

    public function testIterator()
    {
        $elements = $this->buildDummyElements();
        $collection = $this->buildCollection($elements);

        $iterations = 0;
        foreach ($collection->getIterator() as $code => $element) {
            $this->assertEquals($elements[$code], $element);
            ++$iterations;
        }

        $this->assertEquals(3, $iterations);
    }

    public function testCountable()
    {
        $collection = $this->buildCollection();

        $this->assertInstanceOf(\Countable::class, $collection);
        $this->assertCount(0, $collection);
    }

    public function testAll()
    {
        $expected = $this->buildDummyElements();
        $collection = $this->buildCollection($expected);

        $this->assertEquals($expected, $collection->all());
    }

    public function testIsEmpty()
    {
        $collection = $this->buildCollection();

        $this->assertTrue($collection->isEmpty());

        $collection = $this->buildCollection(['code' => new DummyElement('code')]);

        $this->assertFalse($collection->isEmpty());
    }

    public function testHas()
    {
        $collection = $this->buildCollection(['code1' => new DummyElement('code1')]);

        $this->assertTrue($collection->has('code1'));
        $this->assertFalse($collection->has('code2'));
    }

    public function testGet()
    {
        $element = new DummyElement('code');
        $collection = $this->buildCollection(['code' => $element]);

        $this->assertEquals($element, $collection->get('code'));
        $this->assertNull($collection->get('not_exist'));
    }

    public function testSet()
    {
        $element = new DummyElement('code');
        $collection = $this->buildCollection();
        $collection->set('code', $element);

        $this->assertEquals($element, $collection->get('code'));
    }

    public function testRemove()
    {
        $elements = $this->buildDummyElements();
        $collection = $this->buildCollection($elements);

        $this->assertEquals($elements['code1'], $collection->remove('code1'));
        unset($elements['code1']);

        $this->assertFalse($collection->has('code1'));
        $this->assertNull($collection->remove('not_exist'));

        $this->assertEquals($elements['code3'], $collection->remove('code3'));
        unset($elements['code3']);

        $this->assertEquals($elements, $collection->all());
    }

    public function testToArray()
    {
        $collection = $this->buildCollection($this->buildDummyElements());

        $expected = [
            'code1' => ['code' => 'code1'],
            'code2' => ['code' => 'code2'],
            'code3' => ['code' => 'code3'],
        ];

        $this->assertEquals($expected, $collection->toArray());
    }
}
