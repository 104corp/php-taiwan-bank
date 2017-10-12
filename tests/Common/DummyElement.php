<?php
namespace Tests\Common;

use Corp104\Taiwan\Bank\Common\Element;

class DummyElement implements Element
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @param string $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
