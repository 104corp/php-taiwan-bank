<?php
namespace Corp104\Taiwan\Bank;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class BankCollection implements Countable, IteratorAggregate
{
    /**
     * @var array
     */
    private $banks;

    public function __construct(array $banks = [])
    {
        $this->banks = $banks;
    }

    /**
     * @param string $code
     *
     * @return Bank|null
     */
    public function get($code)
    {
        if (!array_key_exists($code, $this->banks)) {
            return null;
        }

        return $this->banks[$code];
    }

    /**
     * @param Bank $bank
     *
     * @return $this
     */
    public function add(Bank $bank)
    {
        $this->banks[$bank->getCode()] = $bank;

        return $this;
    }

    /**
     * @param string $code Bank code
     *
     * @return Bank|null
     */
    public function remove($code)
    {
        if (!array_key_exists($code, $this->banks)) {
            return null;
        }

        $removed = $this->banks[$code];
        unset($this->banks[$code]);

        return $removed;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->banks);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->banks);
    }
}
