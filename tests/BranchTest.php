<?php
namespace Tests;

use Corp104\Taiwan\Bank\Bank;
use Corp104\Taiwan\Bank\Branch;
use Corp104\Taiwan\Bank\BranchCollection;
use Corp104\Taiwan\Bank\Contact;
use PHPUnit\Framework\TestCase;

class BranchTest extends TestCase
{
    /**
     * @return Branch
     */
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

        return $branch;
    }

    /**
     * @depends testConstruct
     * @param Branch $branch
     */
    public function testToArray(Branch $branch)
    {
        $expected = [
            'bank' => [
                'code' => '004',
                'name' => '臺灣銀行',
                'address' => '台北市中正區重慶南路一段120號',
                'contact' => [
                    'name' => '',
                    'phone' => '02-23493456',
                ],
                'url' => 'http://www.bot.com.tw',
                'branches' => [],
                'isActive' => true,
                'updatedAt' => '2017-07-28',
            ],
            'code' => '0040037',
            'name' => '臺灣銀行營業部',
            'address' => '台北市中正區重慶南路一段120號',
            'contact' => [
                'name' => '朱仲之',
                'phone' => '02-23493456',
            ],
            'isActive' => true,
            'updatedAt' => '2016-04-20',
        ];

        $this->assertEquals($expected, $branch->toArray());
    }
}
