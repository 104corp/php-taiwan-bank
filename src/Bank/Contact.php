<?php
namespace Corp104\Taiwan\Bank;

class Contact
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $phone;

    /**
     * @param string $name
     * @param string $phone
     */
    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }
}
