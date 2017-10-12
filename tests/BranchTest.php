<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use Corp104\Taiwan\Bank\Branch;
use Corp104\Taiwan\Bank\BranchCollection;
use Corp104\Taiwan\Bank\Contact;
use PHPUnit\Framework\TestCase;

class BranchTest extends TestCase
{
    public function testConstruct()
    {
        $bank = new Bank(
            '004',
            '臺灣銀行',
            '台北市中正區重慶南路一段120號',
            new Contact('', '02-23493456'),
            'http://www.bot.com.tw',
            new BranchCollection(),
            true,
            '2017-07-28'
        );
        $contact = new Contact('朱仲之', '02-23493456');

        $branch = new Branch(
            $bank,
            '0040037',
            '臺灣銀行營業部',
            '台北市中正區重慶南路一段120號',
            $contact,
            true,
            '2016-04-20'
        );

        $this->assertEquals($bank, $branch->bank);
        $this->assertEquals('0040037', $branch->code);
        $this->assertEquals('0040037', $branch->getCode());
        $this->assertEquals('臺灣銀行營業部', $branch->name);
        $this->assertEquals('台北市中正區重慶南路一段120號', $branch->address);
        $this->assertEquals($contact, $branch->contact);
        $this->assertTrue($branch->isActive);
        $this->assertEquals('2016-04-20', $branch->updatedAt);
    }
}
