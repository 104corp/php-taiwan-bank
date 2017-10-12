<?php
namespace Corp104\Taiwan\Bank;

use Corp104\Taiwan\Bank\Common\Element;

class Branch implements Element
{
    /**
     * @var Bank
     */
    public $bank;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $address;

    /**
     * @var Contact
     */
    public $contact;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var string
     */
    public $updatedAt;

    /**
     * @param Bank $bank
     * @param string $code
     * @param string $name
     * @param string $address
     * @param Contact $contact
     * @param bool $isActive
     * @param string $updatedAt
     */
    public function __construct($bank, $code, $name, $address, $contact, $isActive, $updatedAt)
    {
        $this->bank = $bank;
        $this->code = $code;
        $this->name = $name;
        $this->address = $address;
        $this->contact = $contact;
        $this->isActive = $isActive;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'bank' => $this->bank->toArray(),
            'code' => $this->code,
            'name' => $this->name,
            'address' => $this->address,
            'contact' => $this->contact->toArray(),
            'isActive' => $this->isActive,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
