<?php

namespace Skyfiber\Interfaces;

use Skyfiber\Enums\InboundMailbox;
use Skyfiber\Enums\Priority;
use Skyfiber\Enums\TicketGroup;

interface SonarFieldRequirements
{
    /**
     * Set priority for ticket
     *
     * @return Priority
     */
    public function getPriority(): Priority;


    /**
     * Set inbound mailbox ID for ticket
     *
     * @return InboundMailbox
     */
    public function getInboundMailboxId(): InboundMailbox;

    /**
     * Set Ticket Group ID for Sonar ticket
     *
     * @return TicketGroup
     */
    public function getTicketGroupId(): TicketGroup;

    /**
     * Return subject for ticket creation
     *
     * @return string
     */
    public function getSubject(): string;
}