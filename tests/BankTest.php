<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use Corp104\Taiwan\Bank\Branch;
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

    /**
     * @test
     */
    public function shouldSetBranches()
    {
        $target = new Bank();
        $branch = (new Branch())
            ->setBank($target)
            ->setCode('0040037');

        $actual = $target->setBranches([$branch->getCode() => $branch])->getBranches();

        $this->assertContains($branch, $actual);
        $this->assertCount(1, $actual);
    }

    public function shouldGetBranch()
    {
        $target = new Bank();
        $branch = (new Branch())
            ->setBank($target)
            ->setCode('0040037');
        $target->addBranch($branch);
        $actual = $target->getBranch('0040037');

        $this->assertEquals($branch, $actual);
    }

    /**
     * @test
     */
    public function shouldReturnNullWhenGetNotExistsBranch()
    {
        $target = new Bank();
        $actual = $target->getBranch('0040037');

        $this->assertNull($actual);
    }

    /**
     * @test
     */
    public function shouldRemoveBranch()
    {
        $target = new Bank();
        $branch = (new Branch())
            ->setBank($target)
            ->setCode('0040037');
        $target->addBranch($branch);

        $removed = $target->removeBranch('0040037');

        $this->assertEquals($branch, $removed);
        $this->assertCount(0, $target->getBranches());
    }

    /**
     * @test
     */
    public function shouldReturnNullWhenRemoveNotExistsBranch()
    {
        $target = new Bank();
        $actual = $target->removeBranch('0040037');

        $this->assertNull($actual);
    }
}
