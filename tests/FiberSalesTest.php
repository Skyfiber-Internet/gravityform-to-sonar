<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FiberSalesTest extends TestCase
{

    private \Skyfiber\Models\Forms\FiberSales $object;

    protected function setUp(): void
    {
        $this->object = new \Skyfiber\Models\Forms\FiberSales(
            [
                '2' => 'email@domain.com',
                '3' => '123 123 1234',
                '4' => 'Company',
                '5' => 'Message',
                '6' => 'John Doe',
                '7' => 'Address 321',
            ]
        );
    }

    public function testGetName()
    {
        $this->assertEquals('John Doe (Company)', $this->object->getName());
    }

    public function testToString()
    {
        $this->assertEquals(
            'Name: John Doe<br/>Company: Company<br/>Phone: 123 123 1234<br/>Email: email@domain.com<br/>Address: Address 321<br/>Message: Message<br/>',
            (string)$this->object
        );
    }

    public function testGetSubject()
    {
        $this->assertEquals('SkyFiber FiberSales - John Doe (Company)', $this->object->getSubject());
    }

    public function testInterface()
    {
        $this->assertEquals(\Skyfiber\Enums\Priority::LOW, $this->object->getPriority());
        $this->assertEquals(\Skyfiber\Enums\InboundMailbox::SALES, $this->object->getInboundMailboxId());
        $this->assertEquals(\Skyfiber\Enums\TicketGroup::SALES, $this->object->getTicketGroupId());
    }
}
