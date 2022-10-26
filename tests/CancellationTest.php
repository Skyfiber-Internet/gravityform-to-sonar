<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CancellationTest extends TestCase
{

    private \Skyfiber\Models\Forms\Cancellation $cancellation;

    protected function setUp(): void
    {
        $this->cancellation = new \Skyfiber\Models\Forms\Cancellation(
            [
                '1' => 'email@domain.com',
                '3' => 'John Doe',
                '4' => '123 Fake Street Fake, WA 10005',
                '5' => 'Reason stated here',
                '6' => '2022-02-02',
                '7' => '123 123 1234',
                '8' => 'Account 12',
                '9' => 'Competitor Name',
            ]
        );
    }

    public function testGetName()
    {
        $this->assertEquals('John Doe', $this->cancellation->getName());
    }

    public function testToString()
    {
        $this->assertEquals(
            'Name: John Doe<br/>Phone: 123 123 1234<br/>Email: email@domain.com<br/>Account: Account 12<br/>City: 123 Fake Street Fake, WA 10005<br/>State: 123 Fake Street Fake, WA 10005<br/>Zip: 123 Fake Street Fake, WA 10005<br/>CancelDate: 2022-02-02<br/>Reason: Reason stated here<br/>Competitor: Competitor Name<br/>',
            (string)$this->cancellation
        );
    }

    public function testGetSubject()
    {
        $this->assertEquals('SkyFiber Cancellation - John Doe', $this->cancellation->getSubject());
    }

    public function testInterface()
    {
        $this->assertEquals(\Skyfiber\Enums\Priority::MEDIUM, $this->cancellation->getPriority());
        $this->assertEquals(\Skyfiber\Enums\InboundMailbox::CANCEL, $this->cancellation->getInboundMailboxId());
        $this->assertEquals(\Skyfiber\Enums\TicketGroup::CANCEL, $this->cancellation->getTicketGroupId());
    }
}
