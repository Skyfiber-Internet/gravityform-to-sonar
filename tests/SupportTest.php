<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SupportTest extends TestCase
{

    private \Skyfiber\Models\Forms\Support $support;

    protected function setUp(): void
    {
        $this->support = new \Skyfiber\Models\Forms\Support(
            [
                '2' => 'email@domain.com',
                '3' => '123 123 1234',
                '4' => 'Company',
                '5' => 'Message',
                '6' => 'John Doe',
            ]
        );
    }

    public function testGetName()
    {
        $this->assertEquals('John Doe (Company)', $this->support->getName());
    }

    public function testToString()
    {
        $this->assertEquals(
            'Name: John Doe<br/>Company: Company<br/>Email: email@domain.com<br/>Phone: 123 123 1234<br/>Message: Message<br/>',
            (string)$this->support
        );
    }

    public function testGetSubject()
    {
        $this->assertEquals('SkyFiber Support - John Doe (Company)', $this->support->getSubject());
    }

    public function testInterface()
    {
        $this->assertEquals(\Skyfiber\Enums\Priority::LOW, $this->support->getPriority());
        $this->assertEquals(\Skyfiber\Enums\InboundMailbox::SUPPORT, $this->support->getInboundMailboxId());
        $this->assertEquals(\Skyfiber\Enums\TicketGroup::SUPPORT, $this->support->getTicketGroupId());
    }
}
