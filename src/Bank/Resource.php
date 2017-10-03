<?php
namespace Corp104\Taiwan\Bank;

abstract class Resource implements ResourceInterface
{
    private $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        $this->data = $this->fetchData();

        return $this->data;
    }

    /**
     * @return array
     */
    abstract protected function fetchData();
}
