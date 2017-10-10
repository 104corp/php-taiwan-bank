<?php
namespace Tests;

use Corp104\Taiwan\Bank\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testConstruct()
    {
        $contact = (new Contact())
            ->setName('朱仲之')
            ->setPhone('02-23493456');

        $this->assertEquals('朱仲之', $contact->getName());
        $this->assertEquals('02-23493456', $contact->getPhone());
    }
}
