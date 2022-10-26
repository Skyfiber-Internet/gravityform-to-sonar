<?php

declare(strict_types=1);

namespace Skyfiber\Models\Forms;

use Skyfiber\Enums\InboundMailbox;
use Skyfiber\Enums\Priority;
use Skyfiber\Enums\TicketGroup;
use Skyfiber\Interfaces\SonarFieldRequirements;
use Skyfiber\Models\Base;

class Cancellation extends Base implements SonarFieldRequirements
{
    public string $phone;
    public string $email;
    public string $account;
    public string $street;
    public string $city;
    public string $state;
    public string $zip;
    public string $cancelDate;
    public string $reason;
    public string $competitor;

    /**
     * @inheritDoc
     */
    public function __construct($args = [])
    {
        // values from gravity form
        $args['name'] = $args['3'];
        $args['phone'] = $args['7'];
        $args['email'] = $args['1'];
        $args['account'] = $args['8'];
        $args['city'] = $args['4'];
        $args['state'] = $args['4'];
        $args['zip'] = $args['4'];
        $args['cancelDate'] = $args['6'];
        $args['reason'] = $args['5'];
        $args['competitor'] = $args['9'];
        parent::__construct($args);
    }

    /**
     * @inheritDoc
     */
    public function getPriority(): Priority
    {
        return Priority::MEDIUM;
    }

    /**
     * @inheritDoc
     */
    public function getInboundMailboxId(): InboundMailbox
    {
        return InboundMailbox::CANCEL;
    }

    /**
     * @inheritDoc
     */
    public function getTicketGroupId(): TicketGroup
    {
        return TicketGroup::CANCEL;
    }

}