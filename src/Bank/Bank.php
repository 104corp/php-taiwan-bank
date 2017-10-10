<?php
namespace Corp104\Taiwan\Bank;

class Bank
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $branches = [];

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     *
     * @return $this
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function getBranches()
    {
        return $this->branches;
    }

    /**
     * @param array $branches
     *
     * @return $this
     */
    public function setBranches($branches)
    {
        $this->branches = $branches;

        return $this;
    }

    /**
     * @param string $branchCode
     *
     * @return Branch|null
     */
    public function getBranch($branchCode)
    {
        if (!array_key_exists($branchCode, $this->branches)) {
            return null;
        }

        return $this->branches[$branchCode];
    }

    /**
     * @param Branch $branch
     *
     * @return $this
     */
    public function addBranch(Branch $branch)
    {
        $this->branches[$branch->getCode()] = $branch;

        return $this;
    }

    /**
     * @param string $branchCode
     *
     * @return Branch|null
     */
    public function removeBranch($branchCode)
    {
        if (!array_key_exists($branchCode, $this->branches)) {
            return null;
        }

        $removed = $this->branches[$branchCode];
        unset($this->branches[$branchCode]);

        return $removed;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
