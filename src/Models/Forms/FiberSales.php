<?php declare(strict_types=1);

namespace Skyfiber\Models\Forms;

use Skyfiber\Enums\InboundMailbox;
use Skyfiber\Enums\Priority;
use Skyfiber\Enums\TicketGroup;
use Skyfiber\Interfaces\SonarFieldRequirements;
use Skyfiber\Models\Base;

class FiberSales extends Base implements SonarFieldRequirements
{
    public $phone;
    public $email;
    public $address;
    public $message;

    public function __construct($args = [])
    {
        // values from gravity form
        $args['name'] = $args['6'];
        $args['company'] = $args['4'];
        $args['email'] = $args['2'];
        $args['phone'] = $args['3'];
        $args['address'] = $args['7'];
        $args['message'] = $args['5'];
        parent::__construct($args);
    }

    public function getPriority(): Priority
    {
        return Priority::LOW;
    }

    public function getInboundMailboxId(): InboundMailbox
    {
        return InboundMailbox::SALES;
    }

    public function getTicketGroupId(): TicketGroup
    {
        return TicketGroup::SALES;
    }
}