<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use Corp104\Taiwan\Bank\Branch;
use Corp104\Taiwan\Bank\Contact;
use PHPUnit\Framework\TestCase;

class BranchTest extends TestCase
{
    public function testConstruct()
    {
        $bank = (new Bank())
            ->setCode('004');
        $contact = new Contact();

        $branch = (new Branch())
            ->setBank($bank)
            ->setCode('0040037')
            ->setName('臺灣銀行營業部')
            ->setAddress('台北市中正區重慶南路一段120號')
            ->setContact($contact)
            ->setIsActive(true)
            ->setUpdatedAt('2016-04-20');

        $this->assertEquals($bank, $branch->getBank());
        $this->assertEquals('0040037', $branch->getCode());
        $this->assertEquals('臺灣銀行營業部', $branch->getName());
        $this->assertEquals('台北市中正區重慶南路一段120號', $branch->getAddress());
        $this->assertEquals($contact, $branch->getContact());
        $this->assertTrue($branch->isActive());
        $this->assertEquals('2016-04-20', $branch->getUpdatedAt());
    }
}
