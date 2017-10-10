<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use Corp104\Taiwan\Bank\BranchCollection;
use Corp104\Taiwan\Bank\Contact;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{
    public function testConstruct()
    {
        $contact = new Contact();

        $bank = (new Bank())
            ->setCode('004')
            ->setName('台灣銀行')
            ->setAddress('台北市中正區重慶南路一段120號')
            ->setContact($contact)
            ->setUrl('http://www.bot.com.tw')
            ->setIsActive(true)
            ->setUpdatedAt('2017-07-28');

        $this->assertEquals('004', $bank->getCode());
        $this->assertEquals('台灣銀行', $bank->getName());
        $this->assertEquals('台北市中正區重慶南路一段120號', $bank->getAddress());
        $this->assertEquals($contact, $bank->getContact());
        $this->assertEquals('http://www.bot.com.tw', $bank->getUrl());
        $this->assertTrue($bank->isActive());
        $this->assertEquals('2017-07-28', $bank->getUpdatedAt());
    }

    public function testBranches()
    {
        $target = new Bank();
        $branch = new BranchCollection();

        $actual = $target->setBranches($branch)->getBranches();

        $this->assertEquals($branch, $actual);
    }
}
