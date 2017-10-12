<?php
namespace Corp104\Taiwan\Bank;

use Corp104\Taiwan\Bank\Common\Element;

class Bank implements Element
{
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
     * @var string
     */
    public $url;

    /**
     * @var BranchCollection
     */
    public $branches;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var string
     */
    public $updatedAt;

    /**
     * @param string $code
     * @param string $name
     * @param string $address
     * @param Contact $contact
     * @param string $url
     * @param BranchCollection $branches
     * @param bool $isActive
     * @param string $updatedAt
     */
    public function __construct($code, $name, $address, $contact, $url, $branches, $isActive, $updatedAt)
    {
        $this->code = $code;
        $this->name = $name;
        $this->address = $address;
        $this->contact = $contact;
        $this->url = $url;
        $this->branches = $branches;
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
}
