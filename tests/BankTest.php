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
        $contact = new Contact('', '02-23493456');
        $branches = new BranchCollection();

        $bank = new Bank(
            '004',
            '台灣銀行',
            '台北市中正區重慶南路一段120號',
            $contact,
            'http://www.bot.com.tw',
            $branches,
            true,
            '2017-07-28'
        );

        $this->assertEquals('004', $bank->code);
        $this->assertEquals('004', $bank->getCode());
        $this->assertEquals('台灣銀行', $bank->name);
        $this->assertEquals('台北市中正區重慶南路一段120號', $bank->address);
        $this->assertEquals($contact, $bank->contact);
        $this->assertEquals('http://www.bot.com.tw', $bank->url);
        $this->assertEquals($branches, $bank->branches);
        $this->assertTrue($bank->isActive);
        $this->assertEquals('2017-07-28', $bank->updatedAt);
    }
}
