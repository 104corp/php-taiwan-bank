<?php
namespace Corp104\Taiwan\Bank\Common;

class Collection implements \IteratorAggregate, \Countable
{
    /**
     * @var Element[]
     */
    protected $elements;

    /**
     * ArrayCollection constructor.
     * @param Element[] $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * @return Element[]
     */
    public function all()
    {
        return $this->elements;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->count() === 0;
    }

    /**
     * @param string $code
     *
     * @return bool
     */
    public function has($code)
    {
        return array_key_exists($code, $this->elements);
    }

    /**
     * @param string $code
     *
     * @return Element|null
     */
    public function get($code)
    {
        if (!array_key_exists($code, $this->elements)) {
            return null;
        }

        return $this->elements[$code];
    }

    /**
     * @param string $code
     * @param Element $element
     */
    public function set($code, Element $element)
    {
        $this->elements[$code] = $element;
    }

    /**
     * @param Element $element
     */
    public function add(Element $element)
    {
        $this->set($element->getCode(), $element);
    }

    /**
     * @param string $code
     *
     * @return Element|null
     */
    public function remove($code)
    {
        if (!array_key_exists($code, $this->elements)) {
            return null;
        }

        $removed = $this->elements[$code];
        unset($this->elements[$code]);

        return $removed;
    }
}
